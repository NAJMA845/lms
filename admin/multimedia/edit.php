<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once("../../models/media_room.php");

if (isset($_GET['guid'])) {
    $guid = $_GET['guid'];
    $result = getBookByGUID($conn, $guid);
    $booking = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $res = updateMultimediaByGUID($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Booking updated successfully";
        header("LOCATION:" . ADMIN_BASE_URL . "multimedia");
    } else {
        $_SESSION['error'] = $res["error"];
    }
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
?>

<main class="mt-1 pt-3">
    <div class="container-fluid">
        <h4 class="fw-bold text-uppercase">Edit Multimedia Room Booking</h4>
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <input type="hidden" name="guid" value="<?php echo $booking['guid']; ?>">

                    <div class="mb-3">
                        <label class="form-label">NIC</label>
                        <input type="text" name="nicNo" class="form-control" value="<?php echo $booking['nic_no']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Booking Date</label>
                        <input type="date" name="bookingDate" class="form-control" value="<?php echo $booking['booking_date']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Time Slot</label>
                        <select name="timeSlot" class="form-control" required>
                            <option value="9:00 AM - 11:00 AM" <?php echo ($booking['time_slot'] == "9:00 AM - 11:00 AM") ? "selected" : ""; ?>>9:00 AM - 11:00 AM</option>
                            <option value="11:30 AM - 1:30 PM" <?php echo ($booking['time_slot'] == "11:30 AM - 1:30 PM") ? "selected" : ""; ?>>11:30 AM - 1:30 PM</option>
                            <option value="2:00 PM - 4:00 PM" <?php echo ($booking['time_slot'] == "2:00 PM - 4:00 PM") ? "selected" : ""; ?>>2:00 PM - 4:00 PM</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success" name="update">Update</button>
                    <a href="<?php echo ADMIN_BASE_URL ?>multimedia" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php"); ?>
