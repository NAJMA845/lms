<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");

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
<!-- Main content end -->

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php"); ?>

