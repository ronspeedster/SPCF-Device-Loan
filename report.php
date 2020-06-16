<?php
require_once 'process_student.php';

include('sidebar.php');
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;

$getDevices = $mysqli->query("SELECT * FROM devices
    WHERE deleted = '0'
    ORDER BY price DESC") or die ($mysqli->error);
$getStudentApplication = $mysqli->query('SELECT s.id, s.student_id, s.full_name, s.months, s.level, s.application_date, d.brand, d.model, d.price
    FROM student s
    JOIN devices d
    ON s.device_id = d.id') or die ($mysqli->error);

?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php
        include('topbar.php');
        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Reports</h1>
            </div>

            <!-- Alert here -->
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php } ?>
            <!-- End Alert here -->

            <!-- List of Student -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Amount of Laptop Sold</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="laptopTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Price</th>
                                <th>No. pof Students</th>
                                <th>No. pof Employees</th>
                            </thead>
                            <tbody>
                            <?php while($newDevices=$getDevices->fetch_assoc()){
                                $deviceID = $newDevices['id'];
                                //Employee
                                $getEmployeeAmountDevices = $mysqli->query(" SELECT COUNT(id) AS employe_count FROM employee WHERE device_id = '$deviceID' ") or die ($mysqli->error);
                                $newEmployeeAmountDevices = $getEmployeeAmountDevices->fetch_array();
                                $employe_count = $newEmployeeAmountDevices['employe_count'];
                                //Student
                                $getStudentAmountDevices = $mysqli->query(" SELECT COUNT(id) AS student_count FROM student WHERE device_id = '$deviceID' ") or die ($mysqli->error);
                                $newStudentAmountDevices = $getStudentAmountDevices->fetch_array();
                                $student_count = $newStudentAmountDevices['student_count'];
                                $total_amount = $student_count + $employe_count;

                                ?>
                                <tr>
                                    <td><?php echo $newDevices['brand']; ?></td>
                                    <td><?php echo $newDevices['model']; ?></td>
                                    <td>₱ <?php echo number_format($newDevices['price']); ?> </td>
                                    <td><?php echo $student_count; ?></td>
                                    <td><?php echo $employe_count; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Student Lists -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- JS here -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#laptopTable').DataTable( {
                "pageLength": 25
            } );
        } );
    </script>
    <?php
    include('footer.php');
    ?>
    <style type="text/css">
        /*
        Max width before this PARTICULAR table gets nasty. This query will take effect for any screen smaller than 760px and also iPads specifically.
        */
        @media
        only screen
        and (max-width: 760px), (min-device-width: 768px)
        and (max-device-width: 1024px)  {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin: 0 0 1rem 0;
            }

            tr:nth-child(odd) {
                padding: 1%;
                width: 100%;
                border-bottom: 2px solid grey;
                border-top: 2px solid grey;
                background: #fcfce3;
            }

            td {
                border-bottom: 1px solid #eee;
                position: relative;
            }

            td:before {
                top: 0;
                width: 45%;
                padding-right: 5%;
                white-space: nowrap;
            }

            /*
            Label the data
            You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync.
            */
            td:nth-of-type(1):before { content: "ID:"; font-weight: bold;}
            td:nth-of-type(2):before { content: "Full Name:"; font-weight: bold; }
            td:nth-of-type(3):before { content: "Building Name:"; font-weight: bold; }
            td:nth-of-type(4):before { content: "Building Description:"; font-weight: bold; }
            td:nth-of-type(4):before { content: "Building Description:"; font-weight: bold; }

        }
    </style>
