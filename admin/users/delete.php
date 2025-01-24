<?php
//include_once("../../config/database.php");
include_once("../../models/users.php");
include_once("../../config/config.php");

// Member Delete Functionality
if (isset($_POST['delete'])) {
    $res = deleteUserByGUID($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "User has been deleted Successfully";
        header("LOCATION:" . ADMIN_BASE_URL . "users");
    } else {
        $_SESSION['error'] = $res["error"];
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
    }
}
?>

<!--main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase border-danger"> Delete User </h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="<?php echo ADMIN_BASE_URL ?>users/delete.php">
                            <input type="hidden" name="guid" value="<?php echo $guid ?>" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">Reg No</label>
                                        <input disabled type="text" name="reg_no" id="reg_no"
                                               class="form-control" title=""
                                               value="<?php echo $regNo ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">Name in Full</label>
                                        <input disabled type="text" name="name" id="name"
                                            class="form-control" title="Enter the member's name"
                                            value="<?php echo $memberName ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input disabled type="email" name="email" id="email" class="form-control"
                                            required title="Enter the member's email"
                                            value="<?php echo $email ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">NIC No</label>
                                        <input disabled type="text" name="nic_no" id="nic_no" class="form-control"
                                               required title="Enter the member's NIC No"
                                               value="<?php echo $nicNo ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input disabled type="text" name="phone" id="phone"
                                            class="form-control" required title="Enter the member's phone number"
                                            value="<?php echo $phoneNo ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Address</label>
                                        <input disabled type="text" name="address" id="address"
                                               class="form-control" required title="Enter the member's address"
                                               value="<?php echo $address ?>" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button name="delete" type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        Cancel
                                    </button>
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

<?php
include_once("../../include/footer.php");
?>
