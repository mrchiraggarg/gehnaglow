<?php
include 'adminIncludes/adminHeader.php';
if (isset($_GET['value'])) {
    $value = $_GET['value'];
    if ($value == "3") {
        $success = "Operation Successfully";
    } elseif ($value == "4") {
        $danger = "Failed to Operate";
    }
}
if (isset($_GET['searchVal'])) {
    $searchVal = $_GET['searchVal'];
    $db->select("table_gallery", '*', null, null, null, null);
    $searchResult = $db->showResult();
    foreach ($searchResult as list(
        "id" => $id,
        "image" => $image
    ));
    $data = "CONCAT(id,image)";
    $db->select("table_gallery", '*', null, "$data LIKE '%$searchVal%'", 'id DESC', ROWS_PER_PAGE);
    $getResult = $db->showResult();
} else {
    $db->select("table_gallery", '*', null, null, 'id DESC', ROWS_PER_PAGE);
    $getResult = $db->showResult();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['randcheck'] ==  $_SESSION['randdata']) {

    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];
    $finalImage = "";

    if (isset($_GET['todo'])) {
        $todo = $_GET['todo'];
        if ($todo == "add") {
            $finalImage = $db->imageValidation($image);
            move_uploaded_file($tempImage, "../allUploads/admin/gallery/" . $finalImage);
            $data = [
                "image" => $finalImage
            ];
            $query = $db->insert("table_gallery", $data, null);
            $result = $db->showResult($query);
            if ($query) {
                echo "<script>window.location.replace('adminGallery.php?value=3');</script>";
            } else {
                echo "<script>window.location.replace('adminGallery.php?value=4');</script>";
            }
        }
    }
}
if (isset($_GET['todo'])) {
    $todo = $_GET['todo'];
    if ($todo == 'delete' && isset($_GET['id'])) {
        $id = $_REQUEST['id'];
        $db->select("table_gallery", '*', null, "id='$id'", 'id DESC', ROWS_PER_PAGE);
        $deleteResult = $db->showResult();
        foreach ($deleteResult as list(
            "id" => $delete_id,
            "image" => $delete_image
        ));
        if (file_exists('../allUploads/admin/gallery/' . $delete_image)) unlink('../allUploads/admin/gallery/' . $delete_image);
        $query = $db->delete("table_gallery", "id = '$id'");
        if ($query) {
            echo "<script>window.location.replace('adminGallery.php?value=3');</script>";
        } else {
            echo "<script>window.location.replace('adminGallery.php?value=4');</script>";
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
                                <h1 class="text-primary">Gallery Manager</h1>
                                <p class="text-gray-700 mb-0">This is the screen from where you can manage your all gallery.</p>
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
                List of Your Gallery
            </div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Download</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($getResult as list(
                                "id" => $id,
                                "image" => $image
                            )) {
                            ?>
                                <tr>
                                    <td><?= $image ?></td>
                                    <td>
                                        <a href="../allUploads/admin/gallery/<?= $image ?>" download>
                                            Download Now
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="adminGallery.php?id=<?= $id ?>&todo=delete">
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
                                echo $db->pagination('table_gallery', null, "$data LIKE '%$searchVal%'", ROWS_PER_PAGE);
                            } else {
                                echo $db->pagination('table_gallery', null, null, ROWS_PER_PAGE);
                            }
                            ?>
                        </div>
                        <div class="col-12">
                            <form action="<?= $_SERVER['PHP_SELF'] ?>?todo=add" method="post" enctype="multipart/form-data">
                                <!-- one time thing started -->
                                <?php
                                $rand = rand();
                                $_SESSION['randdata'] = $rand;
                                ?>
                                <input type="hidden" value="<?php echo $rand ?>" name="randcheck" />
                                <!-- one time thing ended -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label class="h6">Select File</label>
                                            <input class="form-control" type="file" name="image" placeholder="Gallery...">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group my-2">
                                            <button type="submit" class="btn btn-blue rounded-pill mr-2"><i data-feather="upload" class="mx-2"></i>Add New</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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