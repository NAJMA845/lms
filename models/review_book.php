<?php
include_once("../config/utility.php");

// Store member
function writeReviewToBook($conn, $param)
{
    $guid = generateGUID();
    extract($param);
    // Validation start
    if (empty($isbn)) {
        return array("error" => "ISBN is required");
    } else if (empty($review)) {
        return array("error" => "Review is required");
    }
    else if (empty($rating)) {
        return array("error" => "Rating is required");
    }

    // Validation end

    $datetime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO book_review (guid, isbn, review, rating,created_at)
            VALUES ('$guid', '$isbn','$review','$rating','$datetime')";
    $result['success'] = $conn->query($sql);
    return $result;
}

function getReviews($conn)
{
    $sql = "select isbn,review,rating from book_review ORDER BY created_at DESC";
    return $conn->query($sql);
}