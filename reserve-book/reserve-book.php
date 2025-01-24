<?php
include_once("../config/config.php");
include_once("../include/header.php");
include_once("../include/topbar.php");
include_once("../include/sidebar.php");
?>

<!-- Main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!-- Book Reservation Section -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Book Reservation</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Fill the form</span>
                    </div>
                    <div class="card-body">
                        <form method="post" action="processBookReservation.php">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="membershipNo" class="form-label">Membership No</label>
                                        <?php
                                        //To allow Admin to enter membership no,
                                        // for non admin, the membership no will be from the login session
                                        if($_SESSION['user_type']=="0"){ ?>
                                            <input type="text" name="membership_no" id="membershipNo" class="form-control" placeholder="Enter Membership No" required>
                                        <?php
                                        } else {?>
                                            <input type="text" name="membership_no" id="membershipNo" class="form-control" placeholder="Enter Membership No" required readonly>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="copyNo" class="form-label">Copy No</label>
                                        <input type="text" name="copy_no" id="copyNo" class="form-control" placeholder="Enter Copy No" value="<?php echo isset($_GET['copy_no']) ? $_GET['copy_no'] : ''; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="reserveOn" class="form-label">Reserve On</label>
                                        <input type="date" name="reserve_on" id="reserveOn" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-12 text-start">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Reserve
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

<?php include_once("../include/footer.php"); ?>
