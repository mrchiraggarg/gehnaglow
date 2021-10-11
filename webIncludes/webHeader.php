<?php
require_once 'constants.php';
require_once 'hereDB.php';
$db = new Database();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<!-- Head Start -->

<head>
  <title>Gehna Glow</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="e-commerce site well design with responsive view." />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="webIncludes/webAssets/image/favicon.png">
  <link href="webIncludes/webAssets/css/bootstrap.min.css" rel="stylesheet" media="screen" />
  <link href="webIncludes/webAssets/javascript/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700,900' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
  <link href="webIncludes/webAssets/css/stylesheet.css" rel="stylesheet">
  <link href="webIncludes/webAssets/css/responsive.css" rel="stylesheet">
  <link href="webIncludes/webAssets/javascript/owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="webIncludes/webAssets/javascript/owl-carousel/owl.transitions.css" type="text/css" rel="stylesheet" media="screen" />
  <script src="webIncludes/webAssets/javascript/jquery-2.1.1.min.js" type="text/javascript"></script>
  <script src="webIncludes/webAssets/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="webIncludes/webAssets/javascript/template_js/jstree.min.js"></script>
  <script type="text/javascript" src="webIncludes/webAssets/javascript/template_js/template.js"></script>
  <script src="webIncludes/webAssets/javascript/common.js" type="text/javascript"></script>
  <script src="webIncludes/webAssets/javascript/global.js" type="text/javascript"></script>
  <script src="webIncludes/webAssets/javascript/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
</head>

<!-- Head End -->

<body class="index">

  <!-- Preloader Start -->

  <div class="preloader loader" style="display: block;background:#000"> <img src="webIncludes/webAssets/image/logo.png" alt="#" /></div>

  <!-- Preloader End -->

  <!-- Header Start -->

  <header>
    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="top-left pull-left">
              <div class="wel-come-msg"> Welcome to our online store! </div>
              <!-- <div class="language">
                <form action="#" method="post" enctype="multipart/form-data" id="language">
                  <div class="btn-group">
                    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> English <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="#">Arabic</a></li>
                      <li><a href="#"> English</a></li>
                    </ul>
                  </div>
                </form>
              </div> -->
              <!-- <div class="currency">
                <form action="#" method="post" enctype="multipart/form-data" id="currency">
                  <div class="btn-group">
                    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown"> <strong>USD</strong> <span class="caret"></span> </button>
                    <ul class="dropdown-menu">
                      <li><a href="#">Euro</a></li>
                      <li><a href="#">Pound</a></li>
                      <li><a href="#">USD</a></li>
                    </ul>
                  </div>
                </form>
              </div> -->
            </div>
            <div class="top-right pull-right">
              <div id="top-links" class="nav pull-right">
                <ul class="list-inline">
                  <li class="dropdown"><a href="#" title="My Account" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span>My Account</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li><a href="register.html">Register</a></li>
                      <li><a href="login.html">Login</a></li>
                    </ul>
                  </li>
                  <!-- <li><a href="#" id="wishlist-total" title="Wish List (0)"><i class="fa fa-heart" aria-hidden="true"></i><span>Wish List</span><span> (0)</span></a></li> -->
                </ul>
                <!-- <div id="search" class="input-group">
                  <input type="text" name="search" value="" placeholder="Search" class="form-control input-lg" />
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
                  </span>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><img src="webIncludes/webAssets/image/logo.png" class="logo-style" alt=""></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-right:5rem;">
        <ul class="nav navbar-nav navbar-right">
          <li class="navbar-style-li"><a href="index.php">Home</a></li>
          <li class="navbar-style-li"><a href="products.php">Products</a></li>
          <li class="navbar-style-li"><a href="about.php">About</a></li>
          <li class="navbar-style-li"><a href="contact.php">Contact</a></li>
          <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li> -->
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>
    <!-- Header End -->