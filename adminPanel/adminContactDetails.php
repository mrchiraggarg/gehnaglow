<?php
require_once 'adminIncludes/adminHeader.php';
$value = $_GET['value'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db->select("table_contacts", '*', null, " id= '$id'", null, null);
    $result = $db->showResult();
    foreach ($result as list(
        "id" => $contact_id,
        "name" => $contact_name,
        "phone" => $contact_phone,
        "email" => $contact_email,
        "subject" => $contact_subject,
        "message" => $contact_message,
        "status" => $contact_status
    ));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['randcheck'] ==  $_SESSION['randdata']) {
    $status = $_POST['status'];

    if (isset($_GET['todo'])) {
        $todo = $_GET['todo'];
        if ($todo == "update") {
            $data = [
                "status" => $status
            ];
            $query = $db->update("table_contacts", $data, "id='$id'", null);
            if ($query) {
                echo "<script>window.location.replace('adminContacts.php?value=3');</script>";
            } else {
                echo "<script>window.location.replace('adminContacts.php?value=4');</script>";
            }
        }
    }
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
                                <h1 class="text-primary">Contacts Manager</h1>
                                <p class="text-gray-700 mb-0">This is the screen from where you can manage your all contacts.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome box end -->
    <div class="row">
        <div class="card mb-4 p-4 col-12">
            <form method="post" action="<?php if ($value == 2) {
                                            echo $_SERVER['PHP_SELF'] . '?id=' . $id . '&value=2&todo=update';
                                        } ?>" enctype="multipart/form-data">
                <!-- one time thing started -->
                <?php
                $rand = rand();
                $_SESSION['randdata'] = $rand;
                ?>
                <input type="hidden" value="<?php echo $rand ?>" name="randcheck" />
                <!-- one time thing ended -->
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" value="<?= $contact_name ?? "" ?>" placeholder="Name..." maxlength="100" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone No.</label>
                            <input class="form-control" type="text" name="phone" value="<?= $contact_phone ?? "" ?>" maxlength="10" placeholder="Phone No..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" value="<?= $contact_email ?? "" ?>" maxlength="100" placeholder="Email..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" required class="form-control p-2">
                                <option value="<?= $contact_status ?>">
                                    <?php if ($contact_status == "0") echo "PENDING";
                                    elseif ($contact_status == "1") echo "CONTACTED"; ?>
                                </option>
                                <option value="0">PENDING</option>
                                <option value="1">CONTACTED</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Subject</label>
                            <input class="form-control" type="text" name="subject" placeholder="Subject..." value="<?= $contact_subject ?? "" ?>" maxlength="100" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" name="message" id="message" required><?= $contact_message ?? "" ?></textarea>
                        </div>
                    </div>
                    <div class="container text-right">
                        <button class="btn btn-blue rounded-pill mr-2" name="submit" type="submit">Submit Contact</button>
                        <!-- <a href="admin-packages.php">
                            <button class="btn btn-blue rounded-pill mr-2" name="back" type="submit">Go Back</button>
                        </a> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'adminIncludes/adminFooter.php';
?>