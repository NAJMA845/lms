<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");

$keyword=isset($_GET['keyword'])?$_GET['keyword']:'';
if ($keyword=='')
    $sql = "SELECT u.id, u.name AS member_name, lf.amount, DATE(lf.paid_date) as paid_date
            FROM late_fees lf
            left JOIN users u ON lf.member_id = u.id
            ORDER BY lf.paid_date DESC";
else
    $sql = "SELECT u.id, u.name AS member_name, lf.amount, lf.paid_date
            FROM late_fees lf
            left JOIN users u ON lf.member_id = u.id
            where u.id like '%$keyword%' or u.name like '%$keyword%' or u.email like '%$keyword%' or u.phone_no like '%$keyword%'
            ORDER BY lf.paid_date DESC";
$result = $conn->query($sql);
?>

<!--main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase">Manage Late Fee</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All late fee
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <form method="get" action="">
                                    <div class="col-md-4">
                                        <label for="isbn" class="form-label">Keyword</label>
                                        <input type="text" name="keyword" class="form-control" placeholder="Enter Membership No, Email, name, Phone">
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <button id="search-btn" class="btn btn-primary w-100">Search</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-responsive table-striped" style="width:100%">
                                <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Membership No</th>
                                    <th scope="col">Member Name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i++ ?></th>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['member_name'] ?></td>
                                            <td><?php echo $row['amount'] ?></td>
                                            <td><?php echo $row['paid_date'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No late fee found.</td></tr>";
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

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php") ?>
