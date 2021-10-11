<?php
require_once 'adminIncludes/adminHeader.php';
$value = $_GET['value'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db->select("table_products", '*', null, " id= '$id'", null, null);
    $result = $db->showResult();
    foreach ($result as list(
        "id" => $productId,
        "title" => $productTitle,
        "shortDesc" => $productShortDesc,
        "description" => $productDescription,
        "price" => $productPrice,
        "category" => $productCategory,
        "type" => $productType,
        "image" => $productImage,
        "createdDate" => $productCreatedDate,
        "modifiedDate" => $productModifiedDate
    ));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['randcheck'] ==  $_SESSION['randdata']) {
    $title = $_POST['title'];
    $slug = $db->slugMaker($title);
    $price = $_POST['price'];
    $shortDesc = $_POST['shortDesc'];
    $description = $_POST['description'];
    $finalDescription = $db->summernote($description);
    $category = $_POST['category'];
    $type = $_POST['type'];
    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];
    $finalImage = "";

    if (isset($_GET['todo'])) {
        $todo = $_GET['todo'];
        if ($todo == "add") {
            $finalImage = $db->imageValidation($image);
            move_uploaded_file($tempImage, "../allUploads/admin/products/" . $finalImage);
            $data = [
                "title" => $title,
                "price" => $price,
                "shortDesc" => $shortDesc,
                "description" => $finalDescription,
                "category" => $category,
                "type" => $type,
                "slug" => $slug,
                "createdDate" => DATE_TODAY,
                "modifiedDate" => DATE_TODAY,
                "image" => $finalImage
            ];
            $query = $db->insert("table_products", $data, $finalDescription);
            $result = $db->showResult($query);
            if ($query) {
                echo "<script>window.location.replace('adminProducts.php?value=3');</script>";
            } else {
                echo "<script>window.location.replace('adminProducts.php?value=4');</script>";
            }
        } elseif ($todo == "update") {
            if ($image == "") {
                $data = [
                    "title" => $title,
                    "price" => $price,
                    "shortDesc" => $shortDesc,
                    "description" => $finalDescription,
                    "type" => $type,
                    "modifiedDate" => DATE_TODAY
                ];
                $query = $db->update("table_products", $data, "id='$id'", $finalDescription);
                if ($query) {
                    echo "<script>window.location.replace('adminProducts.php?value=3');</script>";
                } else {
                    echo "<script>window.location.replace('adminProducts.php?value=4');</script>";
                }
            } else {
                $finalImage = $db->imageValidation($image);
                move_uploaded_file($tempImage, "../allUploads/admin/products/" . $finalImage);
                if (file_exists('../allUploads/admin/products/' . $productImage)) unlink('../allUploads/admin/products/' . $productImage);
                $data = [
                    "title" => $title,
                    "price" => $price,
                    "shortDesc" => $shortDesc,
                    "description" => $finalDescription,
                    "type" => $type,
                    "modifiedDate" => DATE_TODAY,
                    "image" => $finalImage
                ];
            }
            $query = $db->update("table_products", $data, "id='$id'", $finalDescription);
            if ($query) {
                echo "<script>window.location.replace('adminProducts.php?value=3');</script>";
            } else {
                echo "<script>window.location.replace('adminProducts.php?value=4');</script>";
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
                                <h1 class="text-primary">Products Manager</h1>
                                <p class="text-gray-700 mb-0">This is the screen from where you can manage your all products.</p>
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
                            <input class="form-control" type="text" name="title" value="<?= $productTitle ?? "" ?>" placeholder="Title..." maxlength="250" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Short Description</label>
                            <input class="form-control" type="text" name="shortDesc" value="<?= $productShortDesc ?? "" ?>" placeholder="Short Description..." required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" id="description" required><?= $productDescription ?? "" ?></textarea>
                            <script>
                                $("#description").summernote();
                            </script>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" required class="form-control p-2">
                                <?php
                                if ($productCategory != "") {
                                    echo "<option value='$productCategory'>$productCategory</option>";
                                } else {
                                    echo "<option value='Uncategorized'>Uncategorized</option>";
                                }
                                $db->select("table_category", '*', null, null, null, null);
                                $categoryResult = $db->showResult();
                                foreach ($categoryResult as list(
                                    "id" => $categoryId,
                                    "title" => $categoryTitle
                                )) {
                                    echo "<option value='$categoryTitle'>$categoryTitle</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" required class="form-control p-2">
                                <?php
                                if ($productType != "") {
                                    echo "<option value='$productType'>$productType</option>";
                                } else {
                                    echo "<option value='Uncategorized'>Uncategorized</option>";
                                }
                                ?>
                                <option value="Featured">Featured</option>
                                <option value="Best Seller">Best Seller</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Price</label>
                            <input class="form-control" type="number" name="price" value="<?= $productPrice ?? "" ?>" maxlength="7" placeholder="Price.." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image</label>
                            <input class="form-control" type="file" name="image" placeholder="Image...">
                        </div>
                    </div>
                    <div class="container text-right">
                        <button class="btn btn-blue rounded-pill mr-2" name="submit" type="submit">Submit Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'adminIncludes/adminFooter.php';
?>