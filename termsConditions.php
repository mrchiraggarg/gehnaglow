<?php require_once 'webIncludes/webHeader.php';
$db->select("table_pages", '*', null, "id = '2'", null, null);
$pageResult = $db->showResult();
foreach ($pageResult as list(
    "title" => $pageTitle,
    "description" => $pageDescription
));
?>
<div class="breadcrumb parallax">
    <h1><?= $pageTitle ?></h1>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#"><?= $pageTitle ?></a></li>
    </ul>
</div>

<div class="container">
    <div class="row">
        <div class="col-12"><?= $pageDescription ?></div>
    </div>
</div>
<?php require_once 'webIncludes/webFooter.php'; ?>