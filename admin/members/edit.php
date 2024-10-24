<?php
include_once("../../config/database.php");
include_once("../models/members.php");
include_once("../../config/config.php");

// Member
if (isset($_POST['update'])) {
    $res = updateMemberByGUID($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Member has been updated successfully.";
        header("LOCATION:".ADMIN_BASE_URL."members");
    } else {
        $_SESSION['error'] = $res["error"]; // Capture error message
         //header("LOCATION:" . BASE_URL . "members/add.php");
    }
}

include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");

$memberName = '';
$email = '';
$phoneNo = '';
$address = '';

$id = $_SERVER['QUERY_STRING'];
$member = getMemberByGUID($conn, $id);
if (!isset($member->num_rows)) {
    $_SESSION['error'] = "Error: " . $conn->error;
}

if ($member->num_rows > 0) {
    while ($row = $member->fetch_assoc()) {
        $memberName = $row['name'];
        $email = $row['email'];
        $phoneNo = $row['phone_no'];
        $address = $row['address'];
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
                <h4 class="fw-bold text-uppercase"> Edit Member </h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Fill the form
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo ADMIN_BASE_URL?>members/edit.php">
                            <input type="hidden" name="id" value="<?php echo $id ?>" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
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
                                        <label class="form-label">Phone No</label>
                                        <input type="text" class="form-control" name="phone_no" required value="<?php echo $phoneNo ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" required value="<?php echo $address ?>" />
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
