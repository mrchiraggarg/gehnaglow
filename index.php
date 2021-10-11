    <!-- Header Start -->

    <?php require_once './webIncludes/webHeader.php'; ?>

    <!-- Header End -->

    <div class="mainbanner">
      <div id="main-banner" class="owl-carousel home-slider">
        <div class="item"><img src="webIncludes/webAssets/image/banners/Main-Banner1.jpg" alt="main-banner1" style="background: #000; opacity: 0.7;" class="img-responsive" />
          <div class="carousel-caption carousel-caption-style">
            <a href="#">
              <h1>Elegance for Every Moment!
              </h1>
              <button type="button" class="btn btn-primary">Shop Now</button>
            </a>
          </div>
        </div>
        <div class="item"><img src="webIncludes/webAssets/image/banners/Main-Banner2.jpg" alt="main-banner2" style="background: #000; opacity: 0.7;" class="img-responsive" />
          <div class="carousel-caption carousel-caption-style">
            <a href="#">
              <h1>Magical Sparkle Under Budget!
              </h1>
              <button type="button" class="btn btn-primary">Shop Now</button>
            </a>
          </div>
        </div>
        <div class="item"><img src="webIncludes/webAssets/image/banners/Main-Banner3.jpg" alt="main-banner3" style="background: #000; opacity: 0.7;" class="img-responsive" />
          <div class="carousel-caption carousel-caption-style">
            <a href="#">
              <h1>Your Joy, Our Jewellery!</h1>
              <button type="button" class="btn btn-primary">Shop Now</button>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="container">
      <div class="sub-banner">
        <div class="row">
          <div class="col-md-6 cms-banner-left sub-hover"><a href="#"><img alt="#" src="webIncludes/webAssets/image/banners/subbanner1.jpg" class="img-responsive" /></a> </div>
          <div class="col-md-6 cms-banner-right ">
            <div class="right-top-banner sub-hover"><a href="#"><img alt="#" src="webIncludes/webAssets/image/banners/subbanner2.jpg" class="img-responsive" /></a></div>
            <div class="right-bottom-banner sub-hover"><a href="#"><img alt="#" src="webIncludes/webAssets/image/banners/subbanner3.jpg" class="img-responsive" /></a></div>
          </div>
        </div>
      </div>
    </div> -->
    <div id="center">
      <div class="container">
        <div class="row">
          <div class="content col-sm-12">
            <h3 class="productblock-title">Featured Products</h3>
            <div class="row">
              <?php
              $db->select("table_products", '*', null, "type = 'featured'", null, 12);
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
                <div class="col-md-4 col-6">
                  <div class="product-thumb">
                    <div class="allUploads/admin/products/<?= $productImage ?>"> <a href="product.php?product=<?= $productSlug ?>">
                        <img src="allUploads/admin/products/<?= $productImage ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive" />
                        <img src="allUploads/admin/products/<?= $productImage ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive" />
                      </a>
                      <!-- <ul class="button-group grid-btn" style="margin-top: 20px;">
                                <li>
                                    <button type="button" class="wishlist" data-toggle="tooltip" data-placement="top" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                                </li>
                                <li>
                                    <button type="button" class="compare" data-toggle="tooltip" data-placement="top" title="Compare this Product"><i class="fa fa-exchange"></i></button>
                                </li>
                                <li>
                                    <button type="button" class="quick-view" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fa fa-eye"></i></button>
                                </li>
                                <li>
                                    <button type="button" class="addtocart-btn" title="Add to Cart"> Add to Cart </button>
                                </li>
                            </ul> -->
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
              <div class="viewmore">
                <div class="btn buy-now-style"><a href="products.php" class="buy-now-a-style">View More All Products</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="parallax">
      <ul id="testimonial" class="row owl-carousel product-slider">
        <?php
        $db->select("table_testimonial", '*', null, null, null, null);
        $testimonialResult = $db->showResult();
        foreach ($testimonialResult as list(
          "id" => $testimonialId,
          "name" => $testimonialName,
          "location" => $testimonialLocation,
          "message" => $testimonialMessage,
          "image" => $testimonialImage
        )) {
        ?>
          <li class="item">
            <div class="panel-default">
              <div class="testimonial-image"><img src="allUploads/admin/testimonial/<?= $testimonialImage ?>" style="width: 100px;height:100px;border-radius:50%;" alt="#"></div>
              <div class="testimonial-name">
                <h2><?= $testimonialName ?></h2>
              </div>
              <div class="testimonial-designation">
                <p><?= $testimonialLocation ?></p>
              </div>
              <div class="testimonial-desc"><?= $testimonialMessage ?></div>
            </div>
          </li>
        <?php
        }
        ?>
      </ul>
    </div>
    <div class="container">

      <div class="row">
        <div class="content col-sm-12">
          <div class="customtab">
            <h3 class="productblock-title">Best Seller</h3>
            <div class="row">
              <?php
              $db->select("table_products", '*', null, "type = 'best seller'", null, 12);
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
                <div class="col-md-4 col-6">
                  <div class="product-thumb">
                    <div class="allUploads/admin/products/<?= $productImage ?>"> <a href="product.php?product=<?= $productSlug ?>">
                        <img src="allUploads/admin/products/<?= $productImage ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive" />
                        <img src="allUploads/admin/products/<?= $productImage ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive" />
                      </a>
                      <!-- <ul class="button-group grid-btn" style="margin-top: 20px;">
                                <li>
                                    <button type="button" class="wishlist" data-toggle="tooltip" data-placement="top" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                                </li>
                                <li>
                                    <button type="button" class="compare" data-toggle="tooltip" data-placement="top" title="Compare this Product"><i class="fa fa-exchange"></i></button>
                                </li>
                                <li>
                                    <button type="button" class="quick-view" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fa fa-eye"></i></button>
                                </li>
                                <li>
                                    <button type="button" class="addtocart-btn" title="Add to Cart"> Add to Cart </button>
                                </li>
                            </ul> -->
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
            <div class="viewmore">
              <div class="btn buy-now-style"><a href="products.php" class="buy-now-a-style">View More All Products</a></div>
            </div>
          </div>
          <!-- <div id="subbanner4" class="banner">
              <div class="sub-hover"> <a href="#"><img src="webIncludes/webAssets/image/banners/subbanner4.jpg" alt="Sub Banner4" class="img-responsive" /></a> </div>
            </div> -->
        </div>
      </div>
    </div>

    <!-- Footer Start -->

    <?php require_once './webIncludes/webFooter.php'; ?>

    <!-- Footer End -->