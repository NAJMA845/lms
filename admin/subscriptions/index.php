<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
//include_once("../../config/database.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/utility.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");

// Initialize variables
$message = '';
$status = '';

if (isset($_POST['submit'])) {
    $guid = generateGUID();
    $title = $conn->real_escape_string($_POST['title']);
    $amount = floatval($_POST['amount']);
    $duration = intval($_POST['duration']);
    
    $sql = "INSERT INTO subscription_plans (guid, title, amount, duration) 
            VALUES ('$guid', '$title', $amount, $duration)";
    
    if ($conn->query($sql)) {
        $message = 'Plan added successfully!';
        $status = 'success';
    } else {
        $message = 'Error adding plan: ' . $conn->error;
        $status = 'error';
    }
}

// Handle plan deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM subscription_plans WHERE id = $id";
    if ($conn->query($sql)) {
        $message = 'Plan deleted successfully!';
        $status = 'success';
    }
}

// Handle plan status toggle
if (isset($_GET['toggle'])) {
    $id = intval($_GET['toggle']);
    $sql = "UPDATE subscription_plans SET status = NOT status WHERE id = $id";
    if ($conn->query($sql)) {
        $message = 'Plan status updated successfully!';
        $status = 'success';
    }
}

// Fetch all plans
$sql = "SELECT * FROM subscription_plans ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!-- Main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase">Membership Plan</h4>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Plans
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-responsive table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($result->num_rows > 0) {
                                        $counter = 1;
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $counter++; ?></th>
                                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                                        <td><i class="fa-solid fa-rupee-sign me-2"></i><?php echo number_format($row['amount'], 2); ?></td>
                                        <td><?php echo $row['duration']; ?> months</td>
                                        <td>
                                            <span class="badge text-bg-<?php echo $row['status'] ? 'success' : 'danger'; ?>">
                                                <?php echo $row['status'] ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit_plan.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Do you want to delete this plan?')" 
                                               href="?delete=<?php echo $row['id']; ?>" 
                                               class="btn btn-danger btn-sm">Delete</a>
                                            <a href="?toggle=<?php echo $row['id']; ?>" 
                                               class="btn btn-warning btn-sm">
                                                <?php echo $row['status'] ? 'Deactivate' : 'Activate'; ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No plans found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add New Plan
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" required />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Amount</label>
                                        <input type="number" step="0.01" class="form-control" name="amount" required />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Duration (months)</label>
                                        <select class="form-control" name="duration" required>
                                            <option value="">Please select</option>
                                            <option value="6">6 months</option>
                                            <option value="12">12 months</option>
                                            <option value="24">24 months</option>
                                        </select>
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

<!-- Toastify Notification Script -->
<script>
    <?php if (isset($message)): ?>
        Toastify({
            text: "<?php echo $message; ?>",
            duration: 3000, // Duration in ms
            backgroundColor: "<?php echo $status == 'success' ? '#4caf50' : '#f44336'; ?>", // Green for success, red for error
            close: true,
            gravity: "top", // Position: top or bottom
            position: "right", // Position: left, center, or right
            stopOnFocus: true
        }).showToast();
    <?php endif; ?>
</script>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php"); ?>
