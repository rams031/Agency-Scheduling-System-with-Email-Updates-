<?php
session_start();
include '../database/dbsql.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../webpages/csstags.php'; ?>
</head>

<body>
    <div class="main">
        <div class="container is-fullhd">
            <nav id="navbarcentered" class="navbar has-shadow" role="navigation" aria-label="main navigation">
                <div class="navbar-brand">
                    <ul id="ftable" class="menu-list ">
                        <div class="logo"><img id="logodisplay" src="../assets/images/testlogo1.png" width=200></div>
                    </ul>
                    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                </div>
            </nav>
            <div id="maxheight" class="columns">
                <div id="sidenavcustom" class="column is-2">
                    <aside id="sidenav" class="menu">
                        <div id="navbarBasicExample" class="navbar-menu is-shadowless">
                            <div id="list-type">
                                <ul class="menu-list">
                                    <ul id="employeeinfo" class="menu-list ">
                                        <?php include 'employeeinfo.php'; ?>
                                        <div class="is-divider"></div>
                                        <p class="menu-label">
                                            Applications
                                        </p>
                                        <li class="activebox">
                                            <a href="hrportal.php">
                                                Job Applications
                                            </a>
                                        </li>
                                        <p class="menu-label">
                                            Appointments
                                        </p>
                                        <li>
                                            <a href="hrportalappointmenttoday.php">
                                                Appointments Today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="hrportalcalendar.php">
                                                Appointments Calendar
                                            </a>
                                        </li>
                                        <p class="menu-label">
                                            Schedule
                                        </p>
                                        <li>
                                            <a href="hrportalschedulesection.php">
                                                Schedule Section
                                            </a>
                                        </li>
                                        <div class="is-divider"></div>

                                        <p class="menu-label">
                                            Account
                                        </p>
                                        <li class="logout">
                                            <a>
                                                Log out
                                            </a>
                                        </li>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
                <div id="asidenavdivider" class="is-divider-vertical"></div>
                <div class="column is-9">
                    <div class="animate__animated animate__fadeInDown">
                        <table id="applicantTable" class="table table-bordered table-striped" cellspacing="2" width="100%">
                            <thead>
                                <tr style="font-family: 'PT Sans Narrow', sans-serif">
                                    <th>Name</th>
                                    <th>Applying for</th>
                                    <th>Job type</th>
                                    <th>Date Submited</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $status = "forapproval";

                                $sql = ('SELECT tbl_application.appid ,tbl_application.fname,tbl_application.lname, tbl_application.date,tbl_job.jobname,tbl_job.jobtype 
                                    FROM 
                                    tbl_application 
                                    INNER JOIN tbl_job ON tbl_application.jobid = tbl_job.jobid 
                                    WHERE 
                                    tbl_application.status = "forapproval"');

                                $set = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($set)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?></td>
                                        <td><?php echo $row["jobname"]; ?></td>
                                        <td><?php echo $row["jobtype"]; ?></td>
                                        <td><?php echo $row["date"]; ?></td>
                                        <td><a href="hrportalviewapplication.php?appid=<?php echo $row["appid"]; ?>" class="button is-light">View Application</a>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../webpages/scripttags.php'; ?>
</body>

</html>

<script>
    $('#applicantTable').DataTable({responsive:true});
    $(document).ready(function() {
        $(".logout").click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to log out?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4B4A4A',
                cancelButtonColor: '#E7E7E7',
                confirmButtonText: 'Log out'
            }).then((result) => {
                if (result.value) {
                    window.location = "../phpactions/logout.php"
                }
            })
        });

        $(".navbar-burger").click(function() {
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");
        });
    });
</script>