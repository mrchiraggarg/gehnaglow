<?php
require_once '../../constants.php';
require_once '../../hereDB.php';
$db = new Database();

header('Content-type: application/xml');
$var1 =  "<?xml version='1.0' encoding='UTF-8'?>" . "\n";
$var2 = "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>" . "\n";
echo $var1;
echo $var2;

$db->select("table_products", '*', null, null, null, null);
$getResult = $db->showResult();
foreach ($getResult as list(
    "slug" => $slug,
    "modifiedDate" => $modifiedDate
)) {
    echo "<url>";
    echo "<loc>" . CUR_DIR . "products.php?product=" . $slug . "</loc>";
    echo "<lastmod>" . $modifiedDate . "</lastmod>";
    echo "<changefreq>weekly</changefreq>";
    echo "</url>";
}

echo "</urlset>";
