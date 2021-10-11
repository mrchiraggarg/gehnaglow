<?php require_once 'webIncludes/webHeader.php';
if ($_GET['product']) {
    $productSlug = $_GET['product'];
    $db->select("table_products", '*', null, "slug = '$productSlug'", null, null);
    $productResult = $db->showResult();
    foreach ($productResult as list(
        "id" => $productId,
        "title" => $productTitle,
        "image" => $productImage,
        "price" => $productPrice,
        "category" => $productCategory,
        "type" => $productType,
        "shortDesc" => $productShortDesc,
        "description" => $productDescription,
        "slug" => $productSlug
    ));
}
?>
<div class="breadcrumb parallax">
    <h1><?= $productTitle ?></h1>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="#"><?= $productTitle ?></a></li>
    </ul>
</div>
<div class="container">
    <div class="row">
        <div class="content col-sm-12">
            <div class="row">
                <div class="col-sm-5">
                    <div class="thumbnails">
                        <div><a class="thumbnail fancybox" href="allUploads/admin/products/<?= $productImage ?>" title="<?= $productTitle ?>"><img src="allUploads/admin/products/<?= $productImage ?>" title="<?= $productTitle ?>" alt="<?= $productTitle ?>" /></a></div>
                    </div>
                </div>
                <div class="col-sm-7 prodetail">
                    <h1 class="productpage-title"><?= $productTitle ?></h1>
                    <ul class="list-unstyled productinfo-details-top">
                        <li>
                            <h1 class="productpage-price">Rs.<?= $productPrice ?>/-</h1>
                        </li>
                    </ul>
                    <hr>
                    <ul class="list-unstyled product_info">
                        <li>
                            <label>Category:</label>
                            <span> <?= $productCategory ?></span>
                        </li>
                        <li>
                            <label>Type:</label>
                            <span> <?= $productType ?></span>
                        </li>
                        <li>
                            <label>Availability:</label>
                            <span> In Stock</span>
                        </li>
                    </ul>
                    <hr>
                    <p class="product-desc"><?= $productShortDesc ?></p>
                    <!-- <div id="product"> -->
                    <button class="btn btn-primary buy-now-style"">
                        <a href=" https://api.whatsapp.com/send/?phone=918595602133&text=Hello+Gehna+Glow!+I+am+Interested+in+your+Product%3A%0a+Product+Name%3A+<?= $productTitle ?>%0a+Amount%3A+<?= $productPrice ?>+%0a+Link%3A+<?= CUR_DIR ?>product.php<?= '?product=' . $productSlug ?>%0a+Thank+You!&app_absent=0" target="_chirag"> BUY NOW</a>
                    </button>
                </div>
            </div>
            <div class=" productinfo-tab">
                <ul class="nav details-style nav-tabs">
                    <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-description">
                        <div class="cpt_product_description ">
                            <div>
                                <p><?= $productDescription ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once 'webIncludes/webFooter.php'; ?>