<?php
ob_start(); // Start output buffering
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_type = mysqli_real_escape_string($conn, $_POST['memberType']);
    $late_fee_per_day = floatval($_POST['lateFeePerDay']);
    $max_fee = floatval($_POST['maxFee']);

    // Insert the new late fee record into the database
    $insert_query = "INSERT INTO late_fees (member_type, late_fee_per_day, max_fee) 
                     VALUES ('$member_type', $late_fee_per_day, $max_fee)";

    if (mysqli_query($conn, $insert_query)) {
        $_SESSION['success'] = "Late fee added successfully!";
        header("Location: index.php"); // Redirect to the manage page
        exit();
    } else {
        $_SESSION['error'] = "Error adding late fee: " . mysqli_error($conn);
        header("Location: index.php"); // Redirect back to the manage page
        exit();
    }
}

ob_end_flush(); // End output buffering
?>

<!-- Main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!-- Add Late Fee Section -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Add Late Fee</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Fill the form</span>
                    </div>
                    <div class="card-body">
                        <form method="post" action="add.php">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="memberType" class="form-label">Member Type</label>
                                        <select id="memberType" name="memberType" class="form-control" required>
                                            <option value="">Select Member Type</option>
                                            <option value="student">User</option>
                                            <option value="guest">Guest</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lateFeePerDay" class="form-label">Late Fee Per Day (in Rs)</label>
                                        <input type="number" name="lateFeePerDay" id="lateFeePerDay" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="maxFee" class="form-label">Maximum Late Fee (in Rs)</label>
                                        <input type="number" name="maxFee" id="maxFee" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-12 text-start">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Add Late Fee
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        <i class="fas fa-redo"></i> Reset
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
<!-- Main content end -->

<?php include_once("../../include/footer.php"); ?>
