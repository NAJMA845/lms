<?php
include_once("../../config/database.php");
include_once("../models/members.php");
include_once("../../config/config.php");

// Edit Member Functionallity
if (isset($_POST['update'])) {
    $res = updateMemberByGUID($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Member has been updated successfully";
        header("LOCATION:".ADMIN_BASE_URL."members");
    } else {
        $_SESSION['error'] = $res["error"]; // Error handling
    }
}


include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");

$guid = $_SERVER['QUERY_STRING'];
$memberName = '';
$email = '';
$phone_no = '';
$address = '';

$member = getMemberByGUID($conn, $guid);
if (!isset($member->num_rows)) {
    $_SESSION['error'] = "Error: " . $conn->error;
}

if ($member->num_rows > 0) {
    while ($row = $member->fetch_assoc()) {
        $memberName = $row['name'];
        $email = $row['email'];
        $phone_no = $row['phone_no'];
        $address = $row['address'];
    }
}
?>

<!--main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase"> Edit Member </h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Fill the form</div>
                    <div class="card-body">
                        <form method="post" action="<?php echo ADMIN_BASE_URL?>members/edit.php">
                            <input type="hidden" name="guid" value="<?php echo $guid ?>" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">Member Name</label>
                                        <input type="text" name="name" id="name" class="form-control" title="Enter the member name" value="<?php echo $memberName ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" required title="Enter the email" value="<?php echo $email ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone_no" id="phone_no" class="form-control" required title="Enter the phone number" value="<?php echo $phone_no ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" name="address" id="address" class="form-control" required title="Enter the address" value="<?php echo $address ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button name="update" type="submit" class="btn btn-success">Update</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!--main content end-->

<?php
include_once("../../include/footer.php");
?>
