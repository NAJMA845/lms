<?php 
include_once("../../config/config.php");
include_once("../../models/media_room.php");

//Add  Functionality
if (isset($_POST['reserve'])) {
    $res = storeMultimedia($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Multimedia Room booked Successfully";
        header("LOCATION:" . ADMIN_BASE_URL . "multimedia");
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
        <!-- Add Multimedia Room Booking Section -->
        <div class="row">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase">Add Multimedia Room Booking</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Fill the form</span>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo ADMIN_BASE_URL?>multimedia/add.php">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="memberID" class="form-label">NIC</label>
                                        <input type="text" name="nicNo" id="memberID" class="form-control" placeholder="Enter NIC No" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="bookingDate" class="form-label">Booking Date</label>
                                        <input type="date" name="bookingDate" id="bookingDate" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="timeSlot" class="form-label">Time Slot</label>
                                        <select id="timeSlot" name="timeSlot" class="form-control" required>
                                            <option value="">Select Time Slot</option>
                                            <option value="9:00 AM - 11:00 AM">9:00 AM - 11:00 AM</option>
                                            <option value="11:30 AM - 1:30 PM">11:30 AM - 1:30 PM</option>
                                            <option value="2:00 PM - 4:00 PM">2:00 PM - 4:00 PM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 text-start">
                                    <button type="submit" class="btn btn-success" value="reserve" name="reserve">
                                        <i class="fas fa-save"></i>Reserve
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
