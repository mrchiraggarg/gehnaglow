<?php
require 'adminIncludes/adminHeader.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['randcheck'] == $_SESSION['randdata']) {
    $sitemap_data = $_POST['sitemap_data'];
    $fp = fopen('../sitemap.xml', 'w');
    fwrite($fp, $sitemap_data);
    fclose($fp);
}

$response = array();
$fh = fopen('../sitemap.xml', 'r');
$line_count = 0;
while ($line = fgets($fh)) {
    $response[$line_count] = $line;
    $line_count++;
}
fclose($fh);

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
                                <h1 class="text-primary">Settings Manager</h1>
                                <p class="text-gray-700 mb-0">This is the screen from where you can manage your all settings.</p>
                                <p><?php include_once '../webIncludes/webMessage.php'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome box end -->
    <!-- main content box start -->
    <div class="row">
        <div class="card mb-4 p-4 col-12">
            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                <!-- one time thing started -->
                <?php
                $rand = rand();
                $_SESSION['randdata'] = $rand;
                ?>
                <input type="hidden" value="<?php echo $rand ?>" name="randcheck" />
                <!-- one time thing ended -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Sitemap" rows="<?= $line_count ?>" name="sitemap_data">
                                            <?php
                                            for ($i = 0; $i <= $line_count; $i++)
                                                echo $response[$i];
                                            ?>
                                            </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right" name="close">Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'adminIncludes/adminFooter.php'; ?>