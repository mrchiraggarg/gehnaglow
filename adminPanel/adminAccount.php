<?php
require_once 'adminIncludes/adminHeader.php';
$value = $_GET['value'];
if (isset($_GET['value'])) {
    $value = $_GET['value'];
    if ($value == "3") {
        $success = "Submitted Successfully";
    } elseif ($value == "4") {
        $danger = "Failed to Submit";
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db->select("table_admin", '*', null, " id= '$id'", null, null);
    $adminResult = $db->showResult();
    foreach ($adminResult as list(
        "id" => $adminId,
        "name" => $adminName,
        "username" => $adminUsername,
        "password" => $adminPassword,
        "image" => $adminImage
    ));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['randcheck'] ==  $_SESSION['randdata']) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];
    $finalImage = "";

    if (isset($_GET['todo'])) {
        $todo = $_GET['todo'];
        if ($todo == "update") {
            if ($image == "") {
                $data = [
                    "name" => $name,
                    "username" => $username,
                    "password" => $password
                ];
                $query = $db->update("table_admin", $data, "id='$id'", null);
                if ($query) {
                    echo "<script>window.location.replace('adminAccount.php?id=1&value=3');</script>";
                } else {
                    echo "<script>window.location.replace('adminAccount.php?id=1&value=4');</script>";
                }
            } else {
                $finalImage = $db->imageValidation($image);
                move_uploaded_file($tempImage, "../allUploads/admin/account/" . $finalImage);
                if (file_exists('../allUploads/admin/account/' . $adminImage)) unlink('../allUploads/admin/account/' . $adminImage);
                $data = [
                    "name" => $name,
                    "username" => $username,
                    "password" => $password,
                    "image" => $finalImage
                ];
            }
            $query = $db->update("table_admin", $data, "id='$id'", null);
            if ($query) {
                echo "<script>window.location.replace('adminAccount.php?value=3');</script>";
            } else {
                echo "<script>window.location.replace('adminAccount.php?value=4');</script>";
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
                                <h1 class="text-primary">Admin Account Manager</h1>
                                <p class="text-gray-700 mb-0">This is the screen from where you can manage your admin account.</p>
                                <p><?php include_once '../webIncludes/webMessage.php'; ?></p>
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
            <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?id=' . $id . '&value=2&todo=update'; ?>" enctype="multipart/form-data">
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
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" value="<?= $adminName ?? "" ?>" placeholder="Name..." maxlength="100" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" value="<?= $adminUsername ?? "" ?>" maxlength="100" placeholder="Username.." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" value="<?= $adminPassword ?? "" ?>" maxlength="100" placeholder="password.." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image</label>
                            <input class="form-control" type="file" name="image" value="<?= $adminImage ?? "" ?>" maxlength="100" placeholder="Image...">
                        </div>
                    </div>
                    <div class="container text-right">
                        <button class="btn btn-blue rounded-pill mr-2" name="submit" type="submit">Submit Details</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'adminIncludes/adminFooter.php';
?>