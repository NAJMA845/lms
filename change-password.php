<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/users.php");

// Change Password Functionality
if (isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "New password and confirm password do not match.";
    } else {
        $res = changeUserPassword($conn, $_SESSION['id'], $currentPassword, $newPassword);
        if (isset($res['success'])) {
            $_SESSION['success'] = "Password has been updated successfully.";
        } else {
            $_SESSION['error'] = $res["error"];
        }
    }
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
?>

<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <?php include_once($_SERVER['DOCUMENT_ROOT'] ."/lms/include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase">Change Password</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Update Your Password
                    </div>
                    <div class="card-body">
                        <form method="post" action="" onsubmit="return validatePassword()">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required />
                                    </div>
                                    <button type="submit" name="change_password" class="btn btn-success">Update</button>
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

<script>
    function showToast(message) {
        var toastContainer = document.createElement("div");
        toastContainer.className = "toast-container position-fixed bottom-0 end-0 p-3";
        document.body.appendChild(toastContainer);

        var toastHTML = `
            <div class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;

        toastContainer.innerHTML = toastHTML;
        var toastElement = toastContainer.querySelector(".toast");
        var toast = new bootstrap.Toast(toastElement);
        toast.show();
    }

    function validatePassword() {
        var newPassword = document.getElementById("new_password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        if (newPassword !== confirmPassword) {
            showToast("New password and confirm password do not match.");
            return false;
        }
        return true;
    }
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php");
?>
