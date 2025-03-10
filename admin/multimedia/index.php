<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once("../../models/media_room.php");

// Fetch all bookings
$bookings = getMultimediaBookings($conn);

// Handle success and error messages
$successMessage = isset($_SESSION['success']) ? $_SESSION['success'] : "";
$errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : "";
unset($_SESSION['success'], $_SESSION['error']);

include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
?>
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <h4 class="fw-bold text-uppercase">Multimedia Room Bookings</h4>
        
        <?php if (!empty($successMessage)) : ?>
            <div class="alert alert-success"> <?php echo $successMessage; ?> </div>
        <?php endif; ?>
        
        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-danger"> <?php echo $errorMessage; ?> </div>
        <?php endif; ?>
        
        <div class="text-end mb-3">
            <a href="add.php" class="btn btn-primary">+ Add Booking</a>
        </div>

        <div class="card">
            <div class="card-body">
            <table id="data-table" class="table table-responsive table-striped" style="width:100%">
                                <thead class="table-dark">
                                <tr>
                                <th>NIC No</th>
                            <th>Booking Date</th>
                            <th>Time Slot</th>
                            <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                        <?php if ($bookings->num_rows > 0) : ?>
                            <?php while ($row = $bookings->fetch_assoc()) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['nic_no']); ?></td>
                                    <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['time_slot']); ?></td>
                                    <td>
                                        <a href="edit.php?guid=<?php echo $row['guid']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="delete.php?guid=<?php echo $row['guid']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">No bookings available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php"); ?>