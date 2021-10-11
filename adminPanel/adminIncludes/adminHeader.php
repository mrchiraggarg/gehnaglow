<?php
require_once '../constants.php';
require_once '../hereDB.php';
$db = new Database();
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $db->select("table_admin", '*', null, "username='$username'", null, null);
    $adminResult = $db->showResult();
    foreach ($adminResult as list(
        "id" => $adminId,
        "name" => $adminName,
        "username" => $adminUsername,
        "password" => $adminPassword,
        "image" => $adminImage
    ));
    $rows = count($adminResult);
    if (
        $_SERVER['REMOTE_ADDR'] != $_SESSION['ip_address'] || $_SERVER['HTTP_USER_AGENT'] != $_SESSION['useragent']
        || $rows != 1 || time() > ($_SESSION['lastaccess'] + 3600)
    ) {
        logout();
    } else {
        $_SESSION['lastaccess'] = time();
    }
} else {
    logout();
}

function logout()
{
    session_unset();
    session_destroy();
    header("location:index.php");
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
    <title><?= SITE_NAME ?></title>
    <link href="adminIncludes/adminAssets/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="./../webIncludes/webAssets/image/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>

    <!-- include libraries(jQuery, bootstrap) -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <a class="navbar-brand" href="adminDashboard.php"><?= SITE_NAME ?></a>
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><i data-feather="menu"></i></button>
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the md breakpoint-->
        <form class="form-inline mr-auto d-none d-md-block mr-3" method="get" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div class="input-group input-group-joined input-group-solid">
                <input class="form-control mr-sm-2" type="text" name="searchVal" placeholder="Search" aria-label="Search" />
                <div class="input-group-append">
                    <div class="input-group-text"><i data-feather="search"></i></div>
                </div>
            </div>
        </form>
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ml-auto">
            <!-- Navbar Search Dropdown-->
            <!-- * * Note: * * Visible only below the md breakpoint-->
            <li class="nav-item dropdown no-caret mr-3 d-md-none">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a>
                <!-- Dropdown - Search-->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100" method="get" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <div class="input-group input-group-joined input-group-solid">
                            <input class="form-control" type="text" name="searchVal" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                            <div class="input-group-append">
                                <div class="input-group-text"><i data-feather="search"></i></div>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="./../allUploads/admin/account/<?= $adminImage ?>" /></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="./../allUploads/admin/account/<?= $adminImage ?>" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?= $adminName ?></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="adminAccount.php?id=1&value=2">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Account Setting
                    </a>
                    <a class="dropdown-item" href="index.php?todo=logout">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <!-- Sidenav Heading (Addons)-->
                        <div class="sidenav-menu-heading"> Modules</div>
                        <!-- Sidenav Link (Charts)-->
                        <a class="nav-link" href="adminDashboard.php">
                            <div class="nav-link-icon"><i data-feather="corner-down-right"></i></div>
                            Dashboard
                        </a>
                        <!-- Sidenav Link (Charts)-->
                        <a class="nav-link" href="adminProducts.php">
                            <div class="nav-link-icon"><i data-feather="corner-down-right"></i></div>
                            Products
                        </a>
                        <!-- Sidenav Link (Charts)-->
                        <a class="nav-link" href="adminCategory.php">
                            <div class="nav-link-icon"><i data-feather="corner-down-right"></i></div>
                            Category
                        </a>
                        <!-- Sidenav Link (Charts)-->
                        <a class="nav-link" href="adminContacts.php">
                            <div class="nav-link-icon"><i data-feather="corner-down-right"></i></div>
                            Contacts
                        </a>
                        <!-- Sidenav Link (Charts)-->
                        <a class="nav-link" href="adminGallery.php">
                            <div class="nav-link-icon"><i data-feather="corner-down-right"></i></div>
                            Gallery
                        </a>
                        <!-- Sidenav Link (Charts)-->
                        <a class="nav-link" href="adminTestimonials.php">
                            <div class="nav-link-icon"><i data-feather="corner-down-right"></i></div>
                            Testimonials
                        </a>
                        <!-- Sidenav Link (Charts)-->
                        <a class="nav-link" href="adminPages.php">
                            <div class="nav-link-icon"><i data-feather="corner-down-right"></i></div>
                            Pages
                        </a>
                        <!-- Sidenav Link (Charts)-->
                        <a class="nav-link" href="adminSettings.php">
                            <div class="nav-link-icon"><i data-feather="corner-down-right"></i></div>
                            Settings
                        </a>
                    </div>
                </div>
                <!-- Sidenav Footer-->
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title"><?= $adminName ?></div>
                        <!-- <a class="dropdown-item" href="index.php?todo=logout">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Logout
                        </a> -->
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container">
                        <div class="page-header-content pt-4">
                            <div class="row align-items-center justify-content-between">
                                <!-- <div class="col-auto mt-4">
                                    <a href="adminDashboard.php" style="text-decoration:none;">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                                            Dashboard
                                        </h1>
                                    </a>
                                    <div class="page-header-subtitle">Example dashboard overview and content summary</div>
                                </div>
                                <div class="col-12 col-xl-auto mt-4">
                                    <button class="btn btn-white p-3" id="reportrange">
                                        <i class="mr-2 text-primary" data-feather="calendar"></i>
                                        <span></span>
                                        <i class="ml-1" data-feather="chevron-down"></i>
                                    </button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </header>