<!-- Footer Start -->

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 footer-block">
                <div class="footer-logo"> <a href="#"><img alt="index.html" src="webIncludes/webAssets/image/logo.png" class="logo-style" style="margin:0;width:150px;height:150px;"></a> </div>
                <div class="footer-desc"> <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</span> </div>
                <div class="footer-bottom-cms">
                    <div class="footer-payment">
                        <ul>
                            <li class="mastero"><a href="#"><img alt="" src="webIncludes/webAssets/image/payment/mastero.jpg"></a></li>
                            <li class="visa"><a href="#"><img alt="" src="webIncludes/webAssets/image/payment/visa.jpg"></a></li>
                            <li class="currus"><a href="#"><img alt="" src="webIncludes/webAssets/image/payment/currus.jpg"></a></li>
                            <li class="discover"><a href="#"><img alt="" src="webIncludes/webAssets/image/payment/discover.jpg"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 footer-block">
                <h5 class="footer-title">Important</h5>
                <ul class="list-unstyled ul-wrapper">
                    <li><a href="privacyPolicy.php">Privacy Policy</a></li>
                    <li><a href="termsConditions.php">Terms & Conditions</a></li>
                    <li><a href="refundsCancellation.php">Refunds & Cancellations</a></li>
                </ul>
            </div>
            <div class="col-sm-6 footer-block">
                <h5 class="footer-title">Track Us</h5>
                <iframe src="<?= GOOGLE_MAP ?>" style="border:0;width:100%;height:50vh" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
    <a id="scrollup">Scroll</a>
</footer>
<div class="footer-bottom">
    <div class="container">
        <div id="bottom-footer">
            <div class="copyright"> Copyright - <a class="yourstore" href="<?= CUR_DIR ?>"> Created by <?= SITE_NAME ?> &copy; <?= date("Y") ?>.</a> All rights reserved.</div>
        </div>
    </div>
</div>

<!-- Footer End -->

<script src="webIncludes/webAssets/javascript/parally.js"></script>
<script>
    $('.parallax').parally({
        offset: -60
    });
</script>
<script>
    $('.footer-top-cms').parally({
        offset: -200
    });
</script>
</body>

</html>