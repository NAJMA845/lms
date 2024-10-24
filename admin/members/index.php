<?php
include_once("../../config/config.php");
include_once("../../config/database.php");
include_once("../models/members.php");

$members = getMembers($conn);
if (!isset($members->num_rows)) {
    $_SESSION['error'] = "Error: " . $conn->error;
}
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

<!--main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase">Manage Members</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Members
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-responsive table-striped" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone No</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($members->num_rows > 0) {
                                        $i = 1;
                                        while ($row = $members->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['phone_no'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo date("d-m-Y h:i A", strtotime($row['created_at'])) ?></td>
                                        <td>
                                            <a href="<?php echo ADMIN_BASE_URL.'/members/edit.php?id='.$row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="<?php echo ADMIN_BASE_URL.'/members/delete.php?id='.$row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No members found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--main content end-->

<?php include_once("../../include/footer.php") ?>
