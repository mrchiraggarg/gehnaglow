    <!-- Header Start -->

    <?php require_once './webIncludes/webHeader.php'; ?>

    <!-- Header End -->


    <div class="breadcrumb parallax">
        <h1 class="category-title">Products</h1>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Products</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $db->select("table_products", '*', null, null, null, null);
                $productResult = $db->showResult();
                foreach ($productResult as list(
                    "id" => $productId,
                    "title" => $productTitle,
                    "image" => $productImage,
                    "price" => $productPrice,
                    "shortDesc" => $productShortDesc,
                    "slug" => $productSlug
                )) {
                ?>
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="product-thumb">
                            <div class="allUploads/admin/products/<?= $productImage ?>"> <a href="product.php?product=<?= $productSlug ?>">
                                    <img src="allUploads/admin/products/<?= $productImage ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive" />
                                    <img src="allUploads/admin/products/<?= $productImage ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive" />
                                </a>
                            </div>
                            <div class="caption product-detail" style="margin-top: 20px;">
                                <h4 class="product-name"><a href="product.php?product=<?= $productSlug ?>" title="Casual Shirt With Ruffle Hem"><?= $productTitle ?></a></h4>
                                <p class=" price product-price" style="font-size: 3rem !important;margin-top: 20px;">Rs.<?= $productPrice ?>/-</p>
                                <p class="product-desc" style="margin-top: 20px;"><?= $productShortDesc ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Footer Start -->

    <?php require_once './webIncludes/webFooter.php'; ?>

    <!-- Footer End -->