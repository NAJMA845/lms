<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/utility.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/plan_manager.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/form_validator.php");

$planManager = new PlanManager($conn);
$errors = [];
$success = false;

// Get plan ID from URL
$plan_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Handle form submission
if (isset($_POST['submit'])) {
    $data = [
        'title' => $conn->real_escape_string($_POST['title']),
        'amount' => floatval($_POST['amount']),
        'duration' => intval($_POST['duration'])
    ];
    
    // Validate form data
    $errors = validatePlanForm($data);
    
    if (empty($errors)) {
        if ($planManager->updatePlan($plan_id, $data)) {
            $success = true;
        } else {
            $errors['general'] = "Error updating plan: " . $conn->error;
        }
    }
}

// Fetch plan details
$plan = $planManager->getPlanById($plan_id);

// Redirect if plan not found
if (!$plan) {
    header("Location:../subscriptions/index.php");
    exit;
}
?>

<!--Main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Edit Membership Plan</h4>
            </div>

            <!-- Updated column layout for side-by-side form fields -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit Plan Details
                    </div>
                    <div class="card-body">
                        <?php if ($success): ?>
                            <div class="alert alert-success">
                                Plan updated successfully! 
                                <a href="../subscriptions/index.php" class="alert-link">Return to plans list</a>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($errors['general'])): ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($errors['general']); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="">
                            <div class="row">
                                <!-- Title and Amount Side by Side -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" 
                                               class="form-control <?php echo isset($errors['title']) ? 'is-invalid' : ''; ?>" 
                                               name="title" 
                                               value="<?php echo htmlspecialchars($plan['title']); ?>" 
                                               required />
                                        <?php if (isset($errors['title'])): ?>
                                            <div class="invalid-feedback">
                                                <?php echo htmlspecialchars($errors['title']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Amount</label>
                                        <input type="number" 
                                               step="50"
                                               class="form-control <?php echo isset($errors['amount']) ? 'is-invalid' : ''; ?>" 
                                               name="amount" 
                                               value="<?php echo htmlspecialchars($plan['amount']); ?>" 
                                               required />
                                        <?php if (isset($errors['amount'])): ?>
                                            <div class="invalid-feedback">
                                                <?php echo htmlspecialchars($errors['amount']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Duration Side by Side with other fields -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Duration (months)</label>
                                        <select class="form-control <?php echo isset($errors['duration']) ? 'is-invalid' : ''; ?>" 
                                                name="duration" 
                                                required>
                                            <option value="">Please select</option>
                                            <?php
                                            $durations = [1, 3, 6, 12];
                                            foreach ($durations as $duration) {
                                                $selected = $plan['duration'] == $duration ? 'selected' : '';
                                                echo "<option value=\"$duration\" $selected>$duration month" . 
                                                     ($duration > 1 ? 's' : '') . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <?php if (isset($errors['duration'])): ?>
                                            <div class="invalid-feedback">
                                                <?php echo htmlspecialchars($errors['duration']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <button type="submit" name="submit" class="btn btn-success">Update Plan</button>
                                    <a href="plans.php" class="btn btn-secondary">Cancel</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php"); ?>
