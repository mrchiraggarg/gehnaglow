<?php require_once 'webIncludes/webHeader.php';
if (isset($_GET['value'])) {
    $value = $_GET['value'];
    if ($value == "3") {
        $success = "Submitted Successfully";
    } elseif ($value == "4") {
        $danger = "Failed to Submit";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['randcheck'] ==  $_SESSION['randdata']) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (isset($_GET['todo'])) {
        $todo = $_GET['todo'];
        if ($todo == "add") {
            $data = [
                "name" => $name,
                "phone" => $phone,
                "email" => $email,
                "subject" => $subject,
                "message" => $message,
                "dor" => DATE_TODAY,
                "status" => "0"
            ];
            $query = $db->insert("table_contacts", $data, null);
            if ($query) {
                echo "<script>window.location.replace('contact.php?value=3');</script>";
            } else {
                echo "<script>window.location.replace('contact.php?value=4');</script>";
            }
        }
    }
}
?>
<div class="breadcrumb parallax">
    <h1>Contact Us</h1>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</div>
<div class="container">
    <div class="row">
        <p><?php include_once 'webIncludes/webMessage.php'; ?></p>
        <div class="col-md-offset-1 col-md-10">
            <h3 class="contactus-title">You Have Got Questions We have Got Answers</h3>
            <p class="text-center contact-desc">make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="complaint">
                <h2 class="tf">Tel</h2>
                <div class="call-info"><a href="<?= MOBILE_HREF ?>"><?= MOBILE ?></a></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="email">
                <h2 class="tf">Mail</h2>
                <div class="email-info"><a href="<?= EMAIL_HREF ?>"><?= EMAIL ?></a></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="time">
                <h2 class="tf">Time</h2>
                <div class="time-info">24*7</div>
            </div>
        </div>
    </div>
    <div class="main-form" style="margin-bottom: 5rem;">
        <h3 class="contactus-title">Leave Message</h3>
        <div class="row">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?todo=add'; ?>">
                <!-- one time thing started -->
                <?php
                $rand = rand();
                $_SESSION['randdata'] = $rand;
                ?>
                <input type="hidden" value="<?php echo $rand ?>" name="randcheck" />
                <!-- one time thing ended -->
                <div class="col-sm-6">
                    <input type="text" required name="name" placeholder="Name">
                </div>
                <div class="col-sm-6 ">
                    <input type="email" required name="email" placeholder="Email">
                </div>
                <div class="col-sm-6 ">
                    <input type="text" required name="phone" placeholder="Phone Number">
                </div>
                <div class="col-sm-6 ">
                    <input type="text" required name="subject" placeholder="Subject">
                </div>
                <div class="col-xs-12 ">
                    <textarea required name="message" placeholder="Message" rows="3" cols="30"></textarea>
                </div>
                <div class="col-xs-12  text-center">
                    <div class="commun-btn">
                        <button type="submit" name="submit" class="btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once 'webIncludes/webFooter.php'; ?>