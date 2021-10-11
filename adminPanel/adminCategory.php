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
    $db->select("table_category", '*', null, null, null, null);
    $searchResult = $db->showResult();
    foreach ($searchResult as list(
        "id" => $id,
        "title" => $title,
        "slug" => $slug
    ));
    $data = "CONCAT(id,title,slug)";
    $db->select("table_category", '*', null, "$data LIKE '%$searchVal%'", 'id DESC', ROWS_PER_PAGE);
    $getResult = $db->showResult();
} else {
    $db->select("table_category", '*', null, null, 'id DESC', ROWS_PER_PAGE);
    $getResult = $db->showResult();
}
if (isset($_GET['todo']) && isset($_GET['id'])) {
    $todo = $_GET['todo'];
    if ($todo == 'delete') {
        $id = $_REQUEST['id'];
        $db->select("table_category", '*', null, "id='$id'", 'id DESC', ROWS_PER_PAGE);
        $deleteResult = $db->showResult();
        foreach ($deleteResult as list(
            "id" => $deleteId,
            "image" => $deleteImage
        ));
        if (file_exists('../allUploads/admin/category/' . $deleteImage)) unlink('../allUploads/admin/category/' . $deleteImage);
        $query = $db->delete("table_category", "id = '$id'");
        if ($query) {
            echo "<script>window.location.replace('adminProducts.php?value=3');</script>";
        } else {
            echo "<script>window.location.replace('adminProducts.php?value=4');</script>";
        }
    }
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
                                <h1 class="text-primary">Category Manager</h1>
                                <p class="text-gray-700 mb-0">This is the screen from where you can manage your all category.</p>
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
                List of Your Category
            </div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Category Title</th>
                                <th>Category Slug</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($getResult as list(
                                "id" => $id,
                                "title" => $title,
                                "slug" => $slug
                            )) {
                            ?>
                                <tr>
                                    <td><?= $title ?></td>
                                    <td><?= CUR_DIR . 'category/' . $slug ?></td>
                                    <td class="text-center">
                                        <a href="adminCategoryDetails.php?value=2&id=<?= $id ?>">
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></button>
                                        </a>
                                        <a href="adminCategory.php?id=<?= $id ?>&todo=delete">
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
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
                                echo $db->pagination('table_category', null, "$data LIKE '%$searchVal%'", ROWS_PER_PAGE);
                            } else {
                                echo $db->pagination('table_category', null, null, ROWS_PER_PAGE);
                            }
                            ?>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="adminCategoryDetails.php?value=1">
                                <button class="btn btn-blue rounded-pill mr-2" type="submit">Add Category</button>
                            </a>
                        </div>
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