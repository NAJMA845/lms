<?php
include_once("../../config/database.php");
include_once("../models/users.php");
include_once("../../config/config.php");

// Member
if (isset($_POST['update'])) {
    $res = updateUserByGUID($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "User has been updated successfully.";
        header("LOCATION:".ADMIN_BASE_URL."users");
    } else {
        $_SESSION['error'] = $res["error"]; // Capture error message
         //header("LOCATION:" . BASE_URL . "users/add.php");
    }
}

include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");

$memberName = '';
$email = '';
$phoneNo = '';
$nicNo = '';
$address = '';
$is_admin = '';
$is_blocked = '';

$guid = $_SERVER['QUERY_STRING'];
$member = getUserByGUID($conn, $guid);
if (!isset($member->num_rows)) {
    $_SESSION['error'] = "Error: " . $conn->error;
}

if ($member->num_rows > 0) {
    while ($row = $member->fetch_assoc()) {
        $regNo = $row['id'];
        $memberName = $row['name'];
        $email = $row['email'];
        $nicNo = $row['nic_no'];
        $phoneNo = $row['phone_no'];
        $address = $row['address'];
        $is_admin=$row['is_admin'];
        $is_member=$row['is_member'];
        $is_blocked=$row['is_blocked'];
    }
}
?>

<!--main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!--Cards-->
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase"> Edit User </h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Fill the form
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo ADMIN_BASE_URL?>users/edit.php">
                            <input type="hidden" name="guid" value="<?php echo $guid ?>" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Registration No</label>
                                        <input type="text" class="form-control" name="reg_no" required value="<?php echo $regNo ?>" disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name in Full</label>
                                        <input type="text" class="form-control" name="name" required value="<?php echo $memberName ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" required value="<?php echo $email ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">NIC No</label>
                                        <input type="text" class="form-control" name="nic_no" required value="<?php echo $nicNo ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Phone No</label>
                                        <input type="text" class="form-control" name="phone_no" required value="<?php echo $phoneNo ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" required value="<?php echo $address ?>" />
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" <?php echo ($is_admin == 1) ? 'checked' : ''; ?> />
                                        <label class="form-check-label" for="is_admin">Is Admin ?</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="is_member" name="is_member" <?php echo ($is_member == 1) ? 'checked' : ''; ?> />
                                        <label class="form-check-label" for="is_member">Is Member ?</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="is_blocked" name="is_blocked" <?php echo ($is_blocked == 1) ? 'checked' : ''; ?>/>
                                        <label class="form-check-label" for="is_blocked">Is Blocked</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" name="update" class="btn btn-success">Update</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--main content end-->

<?php include_once("../../include/footer.php"); ?>
