<?php
include 'adminIncludes/adminHeader.php';
if (isset($_GET['value'])) {
    $value = $_GET['value'];
    if ($value == "3") {
        $success = "Submitted Successfully";
    } elseif ($value == "4") {
        $danger = "Failed to Submit";
    }
}
if (isset($_GET['searchVal'])) {
    $searchVal = $_GET['searchVal'];
    $db->select("table_metadata", '*', null, null, null, null);
    $check_result = $db->showResult();
    foreach ($check_result as list(
        "id" => $id,
        "page" => $page,
        "meta_title" => $meta_title,
        "meta_description" => $meta_description
    ));
    $data = "CONCAT(id,title,meta_title,meta_description)";
    $db->select("table_metadata", '*', null, "$data LIKE '%$searchVal%'", 'id DESC', ROWS_PER_PAGE);
    $result = $db->showResult();
} else {
    $db->select("table_metadata", '*', null, null, 'id DESC', ROWS_PER_PAGE);
    $result = $db->showResult();
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
    <!-- Example DataTable for Dashboard Demo-->
    <div class="row">
        <div class="card mb-4 col-12">
            <div class="card-header">
                List of Your Settings
            </div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Manage SEO</td>
                                <td class="text-center">
                                    <a href="adminSeo.php">
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Edit Sitemap</td>
                                <td class="text-center">
                                    <a href="adminSitemap.php">
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Create Sitemap</td>
                                <td class="text-center">
                                    <a target="_blank" href="adminIncludes/adminSitemapView.php">
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Sitemap url:</td>
                                <td class="text-center">
                                    <a target="_blank" href="<?= CUR_DIR . "sitemap.xml" ?>">
                                        Sitemap url: <?= CUR_DIR . "sitemap.xml" ?>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6 mt-1">
                            <?php
                            if (isset($_GET['searchVal'])) {
                                echo $db->pagination('table_products', null, "$data LIKE '%$searchVal%'", ROWS_PER_PAGE);
                            } else {
                                echo $db->pagination('table_products', null, null, ROWS_PER_PAGE);
                            }
                            ?>
                        </div>
                    </div>
                    <h3>Important Data's</h3>
                    Sitemap url:
                    <a target="_blank" href="<?= CUR_DIR . "sitemap.xml" ?>">
                        <?= CUR_DIR . "sitemap.xml" ?>
                    </a>
                    <br>
                    Compress Image Before Upload:
                    <a target="_blank" href="https://tinyjpg.com" rel="nofollow">
                        https://tinyjpg.com
                    </a>
                </div>
                <!-- </form> -->
            </div>
        </div>
        <!-- main content box end -->
    </div>
</div>
</main>

<?php
require_once 'adminIncludes/adminFooter.php';
?>