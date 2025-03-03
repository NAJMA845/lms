<?php
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");

$query = "SELECT * FROM late_fees";
$result = mysqli_query($conn, $query);
?>

<!-- Main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Manage Late Fees</h4>
                <?php include_once("../../include/alerts.php"); ?>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Late Fee Overview
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="lateFeeTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Member Type</th>
                                        <th>Late Fee Per Day (Rs)</th>
                                        <th>Maximum Fee (Rs)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . ucfirst($row['member_type']) . "</td>";
                                            echo "<td>" . $row['late_fee_per_day'] . "</td>";
                                            echo "<td>" . $row['max_fee'] . "</td>";
                                            echo "<td>
                                                  <a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary'></i> Edit</a>
                                                  <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger ' onclick='return confirm(\"Are you sure?\")'></i> Delete</a>
                                                  </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No records found</td></tr>";
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
<!-- Main content end -->

<?php include_once("../../include/footer.php"); ?>
