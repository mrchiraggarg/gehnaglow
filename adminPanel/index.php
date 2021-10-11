<?php
// require_once '../web-main.php';
require_once '../constants.php';
require_once '../hereDB.php';
$db = new Database();
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userUsername = $_POST['username'];
    $userPassword = $_POST['password'];

    $db->select("table_admin", '*', null, "username='$userUsername'", null, null);
    $indexResult = $db->showResult();
    $rows = count($indexResult);
    foreach ($indexResult as list(
        "id" => $oldId,
        "username" => $oldUsername,
        "password" => $oldPassword
    ));

    if ($rows > 0 && $userPassword == $oldPassword) {

        $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['useragent'] = $_SERVER["HTTP_USER_AGENT"];
        $_SESSION['username'] = $oldUsername;
        $_SESSION['lastaccess'] = time();
        $success = "Welcome!!";
        header('location:adminDashboard.php');
    } else $danger = "Invalid Data";
} elseif (isset($_GET['todo']) && $_GET['todo'] == 'logout') {
    session_unset();
    session_destroy();
    header("location:index.php");
    exit();
} elseif (isset($_SESSION['username'])) {
    header('location:adminDashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Login | <?= SITE_NAME ?></title>
    <link href="adminIncludes/adminAssets/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../web-assets/images/logo/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <!-- Create Organization-->
                        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
                            <div class="card mt-5">
                                <div class="card-body p-5 text-center">
                                    <div class="icons-org-create align-items-center mx-auto">
                                        <i class="icon-users" data-feather="user"></i>
                                    </div>
                                    <div class="h3 text-primary font-weight-300 mb-0">Admin Login</div>
                                </div>
                                <hr class="m-0" />
                                <div class="card-body p-5">
                                    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                                        <!-- one time thing started -->
                                        <?php
                                        $rand = rand();
                                        $_SESSION['randdata'] = $rand;
                                        ?>
                                        <input type="hidden" value="<?= $rand; ?>" name="randcheck" />
                                        <!-- one time thing ended -->
                                        <div class="form-group">
                                            <input class="form-control form-control-solid" type="text" name="username" placeholder="Enter Username">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-solid" type="password" name="password" placeholder="Enter Password">
                                        </div>
                                        <button type="submit" class="btn btn-block btn-primary">Login</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="footer mt-auto footer-dark">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 small text-center">Copyright &copy; Our Website <?= SITE_NAME . " " . date("Y") ?></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="adminIncludes/adminAssets/js/scripts.js"></script>
</body>

</html>