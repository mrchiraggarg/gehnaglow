<?php require_once 'adminIncludes/adminHeader.php'; ?>
<!-- Main page content-->
<div class="container mt-n10">
    <div class="row">
        <div class="col-xxl-12 col-xl-12 mb-4">
            <div class="card h-100">
                <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                    <div class="row align-items-center">
                        <div class="col-xl-8 col-xxl-12">
                            <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                                <h1 class="text-primary">Welcome to <?= SITE_NAME ?> Admin Dashboard!</h1>
                                <p class="text-gray-700 mb-0">See all stats here in overview.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Example Colored Cards for Dashboard Demo-->
    <div class="row">
        <div class="col-xl-3 col-md-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-3">
                            <div class="text-white-75 small">Products</div>
                            <div class="text-lg font-weight-bold">
                                <?php $db->select("table_products", '*', null, null, null, null);
                                $productResult = $db->showResult();
                                echo count($productResult);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="adminProducts.php">View Products</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-3">
                            <div class="text-white-75 small">Category</div>
                            <div class="text-lg font-weight-bold">
                                <?php $db->select("table_category", '*', null, null, null, null);
                                $categoryResult = $db->showResult();
                                echo count($categoryResult);
                                ?></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="adminCategory.php">View Category</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-3">
                            <div class="text-white-75 small">Contacts</div>
                            <div class="text-lg font-weight-bold">
                                <?php $db->select("table_contacts", '*', null, null, null, null);
                                $contactResult = $db->showResult();
                                echo count($contactResult);
                                ?></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="adminContacts.php">View Contacts</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-3">
                            <div class="text-white-75 small">Gallery</div>
                            <div class="text-lg font-weight-bold">
                                <?php $db->select("table_gallery", '*', null, null, null, null);
                                $galleryResult = $db->showResult();
                                echo count($galleryResult);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="adminGallery#0061f2#0061f2.php">View Gallery</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<?php
require_once 'adminIncludes/adminFooter.php';
?>