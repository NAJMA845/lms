<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/reserve_book.php");

//Add  Functionality
if (isset($_POST['reserve'])) {

    if($_SESSION['user_type']==0){
        $_POST['membershipNo']=$_SESSION['id'];
    }
    $res = storeReserveBook($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Book reservation is successfully done";
        header("LOCATION:" . BASE_URL . "reserve-book/index.php");
    } else {
        $_SESSION['error'] = $res["error"];//"Something went wrong, please try again.";
    }
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
?>

<!-- Main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!-- Book Reservation Section -->
        <div class="row">
            <div class="col-md-12">
                <?php include_once("../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase">Book Reservation</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Fill the form</span>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo BASE_URL?>reserve-book/reserve-book.php">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="copyNo" class="form-label">Copy No</label>
                                        <input type="text" name="copyNo" id="copyNo" class="form-control" placeholder="Enter Copy No" value="<?php echo isset($_GET['copy_no']) ? $_GET['copy_no'] : ''; ?>" required>
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="reserveOn" class="form-label">Reserve On</label>
                                        <input type="date" name="reservedOn" id="reservedOn" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <?php
                                        //To allow Admin to enter membership no,
                                        // for non admin, the membership no will be from the login session
                                        if($_SESSION['user_type']=="1"){ ?>
                                            <label for="membershipNo" class="form-label">Membership No</label>
                                            <input type="text" name="membershipNo" id="membershipNo" class="form-control" placeholder="Enter Membership No" required>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>


                                <div class="col-md-12 text-start">
                                    <button type="submit" class="btn btn-success" name="reserve">
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

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php"); ?>
