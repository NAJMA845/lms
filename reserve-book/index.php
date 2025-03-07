<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/reserve_book.php");

$reservations = getAllReservations($conn);
if (!isset($reservations->num_rows)) {
    $_SESSION['error'] = "Error: " . $conn->error;
}
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
?>

<!--main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">See all reservations</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Reservations
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-responsive table-striped" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">ISBN</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Reserved Date</th>
                                        <?php
                                        if ($_SESSION['user_type']=="1"){
                                            echo '<th scope="col">Reserved By</th>';
                                        }
                                        ?>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($reservations->num_rows > 0) {
                                        $i = 1;
                                        while ($row = $reservations->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php echo $row['title'] ?></td>
                                        <td><?php echo $row['isbn'] ?></td>
                                        <td><?php echo $row['author'] ?></td>
                                        <td><?php echo $row['reservation_date'] ?></td>
                                        <?php
                                        if ($_SESSION['user_type']=="1"){?>
                                            <td><?php echo $row['member_id'] ?></td>
                                            <?php
                                        }
                                        ?>
<!--                                        <td>-->
<!--                                            <a href="--><?php //echo BASE_URL.'reserve-book/delete-reservation.php?'.$row['guid'] ?><!--" class="btn btn-danger btn-sm">Delete</a>-->
<!--                                        </td>-->
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No reservations found.</td></tr>";
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
