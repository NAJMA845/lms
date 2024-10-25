<?php
include_once("../../config/utility.php");

// Store member
function storeMember($conn, $param)
{
    $guid = generateGUID();
    extract($param);

    // Validation start
    if (empty($name)) {
        return array("error" => "Name is required");
    } else if (empty($email)) {
        return array("error" => "Email is required");
    } else if (!isEmailUnique($conn, $email)) {
        return array("error" => "Email is already registered");
    }
    // Validation end

    $datetime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO members (guid, name, phone_no, email, address, created_at)
            VALUES ('$guid', '$name', '$phone_no','$email', '$address', '$datetime')";
    $result['success'] = $conn->query($sql);
    return $result;
}

// Update member
function updateMemberByGUID($conn, $param)
{
    extract($param);

    // Validation start
    if (empty($name)) {
        return array("error" => "Name is required");
    } else if (empty($email)) {
        return array("error" => "Email is required");
    } else if (!isEmailUnique($conn, $email)) {
        return array("error" => "Email is already registered");
    }
    // Validation end

    $datetime = date("Y-m-d H:i:s");
    $sql = "UPDATE members 
            SET name = '$name',
                phone_no = '$phone_no',
                email = '$email',  
                address = '$address', 
                updated_at = '$datetime' 
            WHERE guid = '$guid'";
    $result['success'] = $conn->query($sql);
    return $result;
}

// Get all members
function getMembers($conn)
{
    $sql = "SELECT * FROM members ORDER BY id DESC";
    return $conn->query($sql);
}

// Get a member by GUID
function getMemberByGUID($conn, $guid)
{
    $sql = "select * from members where guid='$guid'";
    $result = $conn->query($sql);
    return $result;
}

// Delete a member by GUID
function deleteMemberByGUID($conn, $param)
{
    extract($param);
    $sql = "DELETE FROM members WHERE guid = '$guid'";
    $result['success'] = $conn->query($sql);
    return $result;
}

// Function to check if email is unique
function isEmailUnique($conn, $email, $id = NULL)
{
    $sql = "SELECT id FROM members WHERE email = '$email'";
    if ($id) {
        $sql .= " AND guid != '$id'";
    }
    return $conn->query($sql)->num_rows == 0;
}
?>

