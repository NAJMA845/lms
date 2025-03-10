<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/utility.php");

// Store booking
function storeMultimedia($conn, $param)
{
    $guid = generateGUID();
    extract($param);

    // Validation
    if (empty($nicNo)) {
        return array("error" => "NIC No is required");
    }
    if (empty($bookingDate)) {
        return array("error" => "Booking date is required");
    }
    if (empty($timeSlot)) {
        return array("error" => "Timeslot is required");
    }

    // Check if the slot is already booked
    if (isBookingAlreadyExists($conn, $bookingDate, $timeSlot, '')) {
        return array("error" => "Cannot book because the date and time are already booked by another person");
    }

    // Insert booking
    $sql = "INSERT INTO multimedia_booking (guid, nic_no, time_slot, booking_date) 
            VALUES ('$guid', '$nicNo', '$timeSlot', '$bookingDate')";
    $queryResult = $conn->query($sql);

    return ($queryResult) ? array("success" => "Booking successful") : array("error" => "Failed to book");
}

// Update booking
function updateMultimediaByGUID($conn, $param)
{
    extract($param);

    // Validation
    if (empty($guid)) {
        return array("error" => "Booking ID is required");
    }
    if (empty($nicNo)) {
        return array("error" => "NIC No is required");
    }
    if (empty($bookingDate)) {
        return array("error" => "Booking date is required");
    }
    if (empty($timeSlot)) {
        return array("error" => "Timeslot is required");
    }

    // Check if the updated slot is already booked
    if (isBookingAlreadyExists($conn, $bookingDate, $timeSlot, $guid)) {
        return array("error" => "Cannot update because the date and time are already booked by another person");
    }

    // Update booking
    $sql = "UPDATE multimedia_booking 
            SET booking_date='$bookingDate', nic_no='$nicNo', time_slot='$timeSlot' 
            WHERE guid='$guid'";

    $queryResult = $conn->query($sql);
    return ($queryResult) ? array("success" => "Booking updated successfully") : array("error" => "Failed to update booking");
}

// Delete booking
function deleteMultimediaBooking($conn, $guid)
{
    if (empty($guid)) {
        return array("error" => "Booking ID is required");
    }

    $sql = "DELETE FROM multimedia_booking WHERE guid='$guid'";
    $queryResult = $conn->query($sql);

    return ($queryResult) ? array("success" => "Booking deleted successfully") : array("error" => "Failed to delete booking");
}

// Get all bookings
function getMultimediaBookings($conn)
{
    $sql = "SELECT * FROM multimedia_booking ORDER BY booking_date";
    return $conn->query($sql);
}

// Get a booking by GUID
function getBookByGUID($conn, $guid)
{
    $sql = "SELECT * FROM multimedia_booking WHERE guid='$guid'";
    return $conn->query($sql);
}

// Check if a booking already exists
function isBookingAlreadyExists($conn, $bookingDate, $timeSlot, $id)
{
    $sql = "SELECT guid FROM multimedia_booking WHERE booking_date = '$bookingDate' AND time_slot = '$timeSlot'";

    if (!empty($id)) {
        $sql .= " AND guid != '$id'";
    }

    $result = $conn->query($sql);
    return ($result->num_rows > 0);
}
?>
