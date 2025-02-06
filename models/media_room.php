<?php
include_once("../../config/utility.php");

//store book
function storeMultimedia($conn, $param)
{
    $guid=generateGUID();
    extract($param);
    ## Validation start
    if (empty($nicNo)) {
        $result = array("error" => "NIC No is required");
        return $result;
    } else if (empty($bookingDate)) {
        $result = array("error" => "Booking date is required");
        return $result;
    } else if (empty($timeSlot)) {
        $result = array("error" => "Timeslot is required");
        return $result;
    }
    if(isBookingAlreadyExists($conn, $bookingDate, $timeSlot,''))
    {
        $result = array("error" => "Cannot book because the date and time are already booked by another person");
        return $result;
    }
    else{
        $datetime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO multimedia_booking (guid,nic_no,time_slot,booking_date)
        VALUES ('$guid','$nicNo', '$timeSlot', '$bookingDate')";
        $result['success']=$conn->query($sql);
        return $result;
    }
}

//update book
function updateMultimediaByGUID($conn, $param)
{
    extract($param);

    if (empty($nicNo)) {
        $result = array("error" => "NIC No is required");
        return $result;
    } else if (empty($BookingDate)) {
        $result = array("error" => "Booking date is required");
        return $result;
    } else if (empty($timeSlot)) {
        $result = array("error" => "Timeslot is required");
        return $result;
    }
    ## Validation end
    $datetime = date("Y-m-d H:i:s");
    $sql = "update multimedia_room 
        set booking_date='$bookingDate',
        nic_no='$nicNo', 
        time_slot='$timeSlot', 
    where guid='$guid'";

    $result['success'] = $conn->query($sql);
    return $result;
}

//get all books
function getMultimediaBookings($conn)
{
    $sql = "select * from multimedia_booking order by booking_date";
    $result = $conn->query($sql);
    return $result;
}
//get a book by GUID
function getBookByGUID($conn,$guid)
{
    $sql = "select * from multimedia_booking where guid='$guid'";
    $result = $conn->query($sql);
    return $result;
}
function isBookingAlreadyExists($conn, $bookingDate, $timeSlot,$id)
{
    $sql = "select guid from multimedia_booking where booking_date = '$bookingDate' and time_slot='$timeSlot'";

    if ($id!='') {
        $sql .= " and guid != '$id'";
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 1)
        return true;

    return false;
}