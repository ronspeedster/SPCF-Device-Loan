<?php
include('sidebar.php');
include('dbh.php');
$getEmployeeApplication = $mysqli->query('SELECT e.id, e.employee_id, e.full_name, e.months, d.brand, d.model, d.price FROM employee e
    JOIN devices d
    ON e.device_id = d.id ') or die ($mysqli->error);
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
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Student Record -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Students</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Full Name</th>
                                <th>Laptop</th>
                                <th>Amount</th>
                                <th>Mos. remaining</th>
                                <th>Due this month</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Student Record -->

            <!-- Student Employees -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Employees</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="employeeTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Full Name</th>
                                <th>Device / Laptop</th>
                                <th>Amount</th>
                                <th>Mos. remaining</th>
                                <th>Due this month</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($newEmployeeApplication=$getEmployeeApplication->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $newEmployeeApplication['employee_id']; ?></td>
                                    <td><?php echo $newEmployeeApplication['full_name']; ?></td>
                                    <td><?php echo $newEmployeeApplication['brand'].' '.$newEmployeeApplication['model']; ?></td>
                                    <td>₱<?php echo number_format($newEmployeeApplication['price'],2); ?></td>
                                    <td><?php echo $newEmployeeApplication['months']; ?></td>
                                    <td><?php echo $newEmployeeApplication['price']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Student Employees -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <!-- JS here -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#employeeTable').DataTable( {
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
