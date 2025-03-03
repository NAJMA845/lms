<?php
ob_start(); // Start output buffering
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");

if (isset($_POST['update'])) {
    $member_type = mysqli_real_escape_string($conn, $_POST['member_type']);
    $late_fee_per_day = floatval($_POST['late_fee_per_day']);
    $max_fee = floatval($_POST['max_fee']);
    $id = intval($_POST['id']);

    // Update the late fee record in the database
    $update_query = "UPDATE late_fees 
                     SET member_type = '$member_type', late_fee_per_day = $late_fee_per_day, max_fee = $max_fee 
                     WHERE id = $id";

    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success'] = "Late fee updated successfully!";
        header("Location: index.php"); // Redirect to the manage page
        exit();
    } else {
        $_SESSION['error'] = "Error updating late fee: " . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM late_fees WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        $_SESSION['error'] = "Record not found!";
        header("Location: index.php");
        exit();
    }
}

ob_end_flush(); // End output buffering
?>

<!-- Main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Edit Late Fee</h4>
                <?php include_once("../../include/alerts.php"); ?>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit Late Fee Record
                    </div>
                    <div class="card-body">
                        <form method="POST" action="edit.php">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                            <div class="form-group">
                                <label for="member_type">Member Type</label>
                                <input type="text" class="form-control" id="member_type" name="member_type" value="<?php echo ucfirst($row['member_type']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="late_fee_per_day">Late Fee Per Day (Rs)</label>
                                <input type="number" step="0.01" class="form-control" id="late_fee_per_day" name="late_fee_per_day" value="<?php echo $row['late_fee_per_day']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="max_fee">Maximum Fee (Rs)</label>
                                <input type="number" step="0.01" class="form-control" id="max_fee" name="max_fee" value="<?php echo $row['max_fee']; ?>" required>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary mt-3">Update</button>
                            <a href="index.php" class="btn btn-secondary mt-3 ml-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Main content end -->

<?php include_once("../../include/footer.php"); ?>

