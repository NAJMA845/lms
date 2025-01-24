<?php
include_once("../../config/config.php");
//include_once("../../config/database.php");
include_once("../../models/users.php");

// Add Member Functionality
if (isset($_POST['submit'])) {
    $res = storeUser($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Member has been created successfully.";
        header("LOCATION:" . ADMIN_BASE_URL . "users");
    } else {
        $_SESSION['error'] = $res["error"]; // Capture error message
    }
}

include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

<!--main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!--Cards-->
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase">Add User</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Fill the form
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo ADMIN_BASE_URL?>users/add.php">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="name" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">NIC No</label>
                                        <input type="text" class="form-control" name="nic_no" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Phone No</label>
                                        <input type="text" class="form-control" name="phone_no" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" required />
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" />
                                        <label class="form-check-label" for="is_admin">Is Admin ?</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="is_member" name="is_member" />
                                        <label class="form-check-label" for="is_member">Is Member ?</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="is_blocked" name="is_blocked" />
                                        <label class="form-check-label" for="is_blocked">Is Blocked ?</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-success">Save</button>
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

<?php
include_once("../../include/footer.php");
?>

