<?php
ob_start(); // Start output buffering

include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $memberID = trim($_POST['memberID']);
    $amount = trim($_POST['amount']);
    $paid_date = date("Y-m-d");

    // Validate input
    if (empty($memberID) || empty($amount)) {
        header("Location: add.php?error=All fields are required");
        exit();
    }

    if (!is_numeric($memberID) || !is_numeric($amount) || $amount <= 0) {
        header("Location: add.php?error=Invalid input values");
        exit();
    }

    // Check if the member exists
    $checkUserQuery = "SELECT id FROM users WHERE id = ?";
    $stmt = $conn->prepare($checkUserQuery);
    $stmt->bind_param("s", $memberID);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        header("Location: add.php?error=Member ID not found");
        exit();
    }

    // Insert into the database
    $insertQuery = "INSERT INTO late_fees (member_id, amount, paid_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sds", $memberID, $amount, $paid_date);

    if ($stmt->execute()) {
        header("Location: add.php?success=Late fee added successfully");
        exit();
    } else {
        header("Location: add.php?error=Failed to add late fee");
        exit();
    }
}

ob_end_flush(); // End output buffering and send output
?>

<main class="mt-1 pt-3">
    <div class="container-fluid">
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
                        <!-- Show success/error message -->
                        <?php
                        if (isset($_GET['success'])) {
                            echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success']) . '</div>';
                        }
                        if (isset($_GET['error'])) {
                            echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
                        }
                        ?>

                        <!-- Form -->
                        <form method="post" action="add.php">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="memberID" class="form-label">Member ID</label>
                                        <input type="number" name="memberID" id="memberID" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Late Fee Amount (Rs)</label>
                                        <input type="number" name="amount" id="amount" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-12 text-start">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Save
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

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php"); ?>
