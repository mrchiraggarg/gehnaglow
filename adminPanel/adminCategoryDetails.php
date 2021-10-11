<?php
require_once 'adminIncludes/adminHeader.php';
$value = $_GET['value'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db->select("table_category", '*', null, " id= '$id'", null, null);
    $result = $db->showResult();
    foreach ($result as list(
        "id" => $categoryId,
        "title" => $categoryTitle,
        "description" => $categoryDescription,
        "image" => $categoryImage,
        "createdDate" => $categoryCreatedDate,
        "modifiedDate" => $categoryModifiedDate
    ));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['randcheck'] ==  $_SESSION['randdata']) {
    $title = $_POST['title'];
    $slug = $db->slugMaker($title);
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];
    $finalImage = "";

    if (isset($_GET['todo'])) {
        $todo = $_GET['todo'];
        if ($todo == "add") {
            $finalImage = $db->imageValidation($image);
            move_uploaded_file($tempImage, "../allUploads/admin/category/" . $finalImage);
            $data = [
                "title" => $title,
                "slug" => $slug,
                "description" => $description,
                "createdDate" => DATE_TODAY,
                "modifiedDate" => DATE_TODAY,
                "image" => $finalImage
            ];
            $query = $db->insert("table_category", $data, null);
            $result = $db->showResult($query);
            if ($query) {
                echo "<script>window.location.replace('adminCategory.php?value=3');</script>";
            } else {
                echo "<script>window.location.replace('adminCategory.php?value=4');</script>";
            }
        } elseif ($todo == "update") {
            if ($image == "") {
                $data = [
                    "title" => $title,
                    "description" => $description,
                    "modifiedDate" => DATE_TODAY
                ];
                $query = $db->update("table_category", $data, "id='$id'", null);
                if ($query) {
                    echo "<script>window.location.replace('adminCategory.php?value=3');</script>";
                } else {
                    echo "<script>window.location.replace('adminCategory.php?value=4');</script>";
                }
            } else {
                move_uploaded_file($tempImage, "../allUploads/admin/category/" . $finalImage);
                if (file_exists('../allUploads/admin/category/' . $categoryImage)) unlink('../allUploads/admin/category/' . $categoryImage);
                $data = [
                    "title" => $title,
                    "description" => $description,
                    "modifiedDate" => DATE_TODAY,
                    "image" => $finalImage
                ];
            }
            $query = $db->update("table_category", $data, "id='$id'", null);
            if ($query) {
                echo "<script>window.location.replace('adminCategory.php?value=3');</script>";
            } else {
                echo "<script>window.location.replace('adminCategory.php?value=4');</script>";
            }
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome box end -->
    <div class="row">
        <div class="card mb-4 p-4 col-12">
            <form method="post" action="<?php if ($value == 1) {
                                            echo $_SERVER['PHP_SELF'] . '?value=1&todo=add';
                                        } elseif ($value == 2) {
                                            echo $_SERVER['PHP_SELF'] . '?id=' . $id . '&value=2&todo=update';
                                        } ?>" enctype="multipart/form-data">
                <!-- one time thing started -->
                <?php
                $rand = rand();
                $_SESSION['randdata'] = $rand;
                ?>
                <input type="hidden" value="<?php echo $rand ?>" name="randcheck" />
                <!-- one time thing ended -->
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title" value="<?= $categoryTitle ?? "" ?>" placeholder="Title..." maxlength="250" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <input class="form-control" type="text" name="description" value="<?= $categoryDescription ?? "" ?>" placeholder="Description..." required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Image</label>
                            <input class="form-control" type="file" name="image" placeholder="Image...">
                        </div>
                    </div>
                    <div class="container text-right">
                        <button class="btn btn-blue rounded-pill mr-2" name="submit" type="submit">Submit Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'adminIncludes/adminFooter.php';
?>