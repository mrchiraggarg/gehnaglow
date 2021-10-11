<?php
include 'adminIncludes/adminHeader.php';
if (isset($_GET['value'])) {
    $value = $_GET['value'];
    if ($value == "3") {
        $success = "Submitted Successfully";
    } elseif ($value == "4") {
        $danger = "Failed to Submit";
    }
}
if (isset($_GET['searchVal'])) {
    $searchVal = $_GET['searchVal'];
    $db->select("table_contacts", '*', null, null, null, null);
    $check_result = $db->showResult();
    foreach ($check_result as list(
        "id" => $id,
        "name" => $name,
        "phone" => $phone,
        "email" => $email,
        "dor" => $dor,
        "subject" => $subject,
        "status" => $status
    ));
    $data = "CONCAT(id,name,phone,email,dor,subject,status)";
    $db->select("table_contacts", '*', null, "$data LIKE '%$searchVal%'", 'id DESC', ROWS_PER_PAGE);
    $result = $db->showResult();
} else {
    $db->select("table_contacts", '*', null, null, 'id DESC', ROWS_PER_PAGE);
    $result = $db->showResult();
}
?>

<!-- Main page content-->
<div class="container mt-n10">
    <div class="row">
        <!-- welcome box start -->
        <div class="col-xxl-12 col-xl-12 mb-4">
            <div class="card h-100">
                <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                                <h1 class="text-primary">Contacts Manager</h1>
                                <p class="text-gray-700 mb-0">This is the screen from where you can manage your all contacts.</p>
                                <p><?php include_once '../webIncludes/webMessage.php'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome box end -->
    <!-- main content box start -->
    <!-- Example DataTable for Dashboard Demo-->
    <div class="row">
        <div class="card mb-4 col-12">
            <div class="card-header">
                List of Your Contacts
            </div>
            <div class="card-body">
                <!-- <form method="get" action="<?php $_SERVER["PHP_SELF"]; ?>"> -->
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>phone No.</th>
                                <th>Email</th>
                                <th>D.O.R.</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <!-- <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot> -->
                        <tbody>
                            <?php
                            foreach ($result as list(
                                "id" => $id,
                                "name" => $name,
                                "phone" => $phone,
                                "email" => $email,
                                "dor" => $dor,
                                "subject" => $subject,
                                "status" => $status
                            )) {
                            ?>
                                <tr>
                                    <td><?= $name ?></td>
                                    <td><?= $phone ?></td>
                                    <td><?= $email ?></td>
                                    <td><?= $dor ?></td>
                                    <td><?= $subject ?></td>
                                    <td>
                                        <div class="badge 
                                        <?php if ($status == "0") echo "badge-warning";
                                        elseif ($status == "1") echo "badge-success"; ?> 
                                                            badge-pill">
                                            <?php if ($status == "0") echo "PENDING";
                                            elseif ($status == "1") echo "CONTACTED"; ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="adminContactDetails.php?value=2&id=<?= $id ?>">
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6 mt-1">
                            <?php
                            if (isset($_GET['searchVal'])) {
                                echo $db->pagination('table_contacts', null, "$data LIKE '%$searchVal%'", ROWS_PER_PAGE);
                            } else {
                                echo $db->pagination('table_contacts', null, null, ROWS_PER_PAGE);
                            }
                            ?>
                        </div>
                        <!-- <div class="col-md-6 text-right">
                            <a href="adminProductDetails.php?value=1">
                                <button class="btn btn-blue rounded-pill mr-2" type="submit">Add Product</button>
                            </a>
                        </div> -->
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
        <!-- main content box end -->
    </div>
</div>
</main>

<?php
require_once 'adminIncludes/adminFooter.php';
?>