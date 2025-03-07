<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/utility.php");
// Handle new subscription creation
if (isset($_POST['submit-membership']) ){
    $member_id = intval($_POST['member_id']);
    $plan_id = intval($_POST['plan_id']);
    $guid=generateGUID();
    // Get plan details
    $plan_query = "SELECT duration FROM subscription_plans WHERE id = $plan_id";
    $plan_result = $conn->query($plan_query);
    $plan = $plan_result->fetch_assoc();
    $subscription_end = (int) $plan['duration']; // Ensure it is an integer

    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d', strtotime("+$subscription_end months", strtotime($start_date)));

    $conn->begin_transaction(); // Start transaction

    try {
        // Prepared statement for inserting subscription
        $sql1 = "INSERT INTO subscriptions (guid, member_id, plan_id, start_date, end_date) 
             VALUES (?, ?, ?, ?, ?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("siiss", $guid, $member_id, $plan_id, $start_date, $end_date);
        $stmt1->execute();

        // Prepared statement for updating user subscription status
        $sql2 = "UPDATE users SET is_member=1, subscription_active = 1 WHERE id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $member_id);
        $stmt2->execute();

        // Commit the transaction if both queries succeed
        $conn->commit();
        // Redirect to prevent form resubmission on refresh
        header("Location: ".ADMIN_BASE_URL."subscriptions/subscrption-purchase-history.php");
    } catch (Exception $e) {
        // Rollback the transaction if any query fails
        $conn->rollback();
        echo "<script>alert('Error creating subscription: " . $conn->error . "');</script>";
    } finally {
        // Close the prepared statements
        $stmt1->close();
        $stmt2->close();
    }
}
?>