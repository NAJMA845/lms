<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/utility.php");

// Store member
function storeUser($conn, $param)
{
    $guid = generateGUID();
    extract($param);
    // Validation start
    if (empty($name)) {
        return array("error" => "Name is required");
    } else if (empty($email)) {
        return array("error" => "Email is required");
    }
    else if (empty($address)) {
        return array("error" => "Address is required");
    }
    else if (empty($phone_no)) {
        return array("error" => "Phone No is required");
    }
    // Validation end

    $datetime = date("Y-m-d H:i:s");
    $pwd=md5($nic_no);
    $sql = "INSERT INTO users (guid, name, nic_no, password, email, phone_no, address,is_member,is_admin,is_blocked, created_at)
            VALUES ('$guid', '$name','$nic_no','$pwd', '$email', '$phone_no', '$address','$is_member','$is_admin','$is_blocked', '$datetime')";
    $result['success'] = $conn->query($sql);
    return $result;
}

// Update member
function updateUserByGUID($conn, $param)
{
    extract($param);

    // Validation start
    if (empty($name)) {
        return array("error" => "Name is required");
    } else if (empty($email)) {
        return array("error" => "Email is required");
    }
    else if (empty($address)) {
        return array("error" => "Address is required");
    }
    else if (empty($phone_no)) {
        return array("error" => "Phone No is required");
    }
    // Validation end

    $datetime = date("Y-m-d H:i:s");
    $sql = "UPDATE users 
            SET name = '$name',
                email = '$email', 
                phone_no = '$phone_no', 
                address = '$address',
                nic_no = '$nic_no',
                is_member = '$is_member',
                is_admin = '$is_admin',
                is_blocked = '$is_blocked',
                updated_at = '$datetime'
            WHERE guid = '$guid'";
    $result['success'] = $conn->query($sql);
    return $result;
}

// Get all users
function getUsers($conn,$keyword)
{
    if($keyword=='')
        $sql = "SELECT * FROM users where is_default=0 ORDER BY id DESC";
    else
        $sql = "SELECT * FROM users where (name like '%$keyword%' or email like '%$keyword%' or phone_no like '%$keyword%' or nic_no like '%$keyword%') and is_default=0 ORDER BY id DESC";
    return $conn->query($sql);
}

// Get a member by GUID
function getUserByGUID($conn, $guid)
{
    $sql = "SELECT * FROM users WHERE guid = '$guid'";
    return $conn->query($sql);
}

// Delete a member by GUID
function deleteUserByGUID($conn, $param)
{
    extract($param);
    $sql = "DELETE FROM users WHERE guid = '$guid'";
    $result['success'] = $conn->query($sql);
    return $result;
}

function getActiveMembers($conn)
{
    $sql = "SELECT count(*) as active_members  FROM users WHERE is_member =1 and subscription_active=1";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['active_members'];
    }
    //If result has issue, return 0
    return 0;
}

function changeUserPassword($conn, $user, $currentPassword, $newPassword){
    $currentPwd = md5($currentPassword);
    $newPwd = md5($newPassword);

    // Check if the current password matches
    $sql = "SELECT id FROM users WHERE id = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user, $currentPwd);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, proceed with updating password
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newPwd, $user);

        if ($stmt->execute()) {
            return array("success" => "Password has been changed successfully!");
        } else {
            return array("error" => "Failed to update password. Please try again.");
        }
    } else {
        return array("error" => "Invalid current password. Try again with a valid password.");
    }
}

?>
