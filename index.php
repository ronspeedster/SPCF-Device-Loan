<?php
include('sidebar.php');
include('dbh.php');
$getEmployeeApplication = $mysqli->query('SELECT e.id, e.employee_id, e.full_name, e.months, d.brand, d.model, d.price FROM employee e
    JOIN devices d
    ON e.device_id = d.id ') or die ($mysqli->error);

$getStudentApplication = $mysqli->query("SELECT s.id, s.student_id, s.full_name, s.months, s.level, s.application_date, d.brand, d.model, d.price
    FROM student s
    JOIN devices d
    ON s.device_id = d.id
    LIMIT 5" 
    ) or die ($mysqli->error);
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
                        <table class="table table-bordered" id="studentTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Full Name</th>
                                <th>Level</th>
                                <th>Laptop</th>
                                <th>Price</th>
                                <th>Balance</th>
                                <th>Mos. remaining</th>
                                <th>Due this month</th>
                                <th>Application Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while($newStudentApplication=$getStudentApplication->fetch_assoc()){
                            $id = $newStudentApplication['id'];
                            //Student
                            $getMonth = $mysqli->query(" SELECT COUNT(id) AS month_paid FROM payment
                                WHERE application_id = '$id'
                                AND class = 'student' ") or die ($mysqli->error);
                            $newMonth = $getMonth->fetch_array();

                            $months = $newStudentApplication['months'] - $newMonth['month_paid'];

                            $getCollectedStudent = $mysqli->query(" SELECT SUM(p.payment) AS total_collected
                                FROM payment p
                                WHERE p.application_id = '$id'
                                AND p.class = 'student' ") or die ($mysqli->error);
                            $newCollectedStudent = $getCollectedStudent->fetch_array();
                            $remainingBalance = $newStudentApplication['price']-$newCollectedStudent['total_collected'];

                            $dueThisMonth = $remainingBalance / $months;
                                ?>
                                <tr>
                                    <td>
                                        <a target="_blank" href="add_payment.php?classification=student&id=<?php echo $id; ?>">
                                            <?php echo $newStudentApplication['student_id']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="add_payment.php?classification=student&id=<?php echo $id; ?>">
                                            <?php echo strtoupper($newStudentApplication['full_name']); ?>
                                        </a>
                                    </td>
                                    <td><?php echo strtoupper($newStudentApplication['level']); ?></td>
                                    <td><?php echo $newStudentApplication['brand'].' '.$newStudentApplication['model']; ?></td>
                                    <td>₱ <?php echo number_format($newStudentApplication['price'],2); ?></td>
                                    <td class="text-danger">₱ <?php echo number_format($remainingBalance,2); ?></td>
                                    <td class="font-weight-bold"><?php echo $months; ?></td>
                                    <td>₱ <?php echo number_format($dueThisMonth,2); ?></td>
                                    <td><?php echo $newStudentApplication['application_date']; ?></td>
                                    <td>
                                        <!-- Start Drop down Delete here -->
                                        <a href="student.php?edit=<?php echo $newStudentApplication['id']; ?>" class="btn btn-info btn-sm mb-1"><i class="far fa-edit"></i> Edit</a>
                                        <button class="btn btn-danger btn-secondary dropdown-toggle btn-sm mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="far fa-trash-alt"></i> Delete
                                        </button>
                                        <div class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton btn-sm">
                                            Are you sure you want to delete? You cannot undo the changes<br/>
                                            <a href="process_student.php?delete=<?php echo $id; ?>" class='btn btn-danger btn-sm'>
                                                <i class="far fa-trash-alt"></i> Confirm Delete
                                            </a>
                                            <a href="#" class='btn btn-success btn-sm'><i class="far fa-window-close"></i> Cancel</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <center><a href="student.php">Show More</a></center>
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
        $(document).ready(function() {
            $('#studentTab').DataTable( {
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
