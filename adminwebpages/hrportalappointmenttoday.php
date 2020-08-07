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
                                        <li>
                                            <a href="hrportal.php">
                                                Job Applications
                                            </a>
                                        </li>
                                        <p class="menu-label">
                                            Appointments
                                        </p>
                                        <li class="activebox">
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
                        <h1 id="titles" class="tag">Appointments Today</h1>
                        <div class="card is-shadowless">
                            <div class="card-content">

                                <?php

                                $i = 0;
                                $sql = ("select 
                                    CURDATE() as date");

                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                if (mysqli_num_rows($result) == 1) {

                                    $datenow = $row['date'];
                                    $ctr = 0;

                                    $user_check_query = ("SELECT 
                                        *  
                                        FROM 
                                        `tbl_events` 
                                        JOIN tbl_forschedule ON tbl_forschedule.schedid = tbl_events.schedid
                                        JOIN tbl_application on tbl_application.appid = tbl_forschedule.appid
                                        JOIN tbl_job on tbl_job.jobid = tbl_application.jobid
                                        where
                                        tbl_forschedule.userid = $id and tbl_events.start_time between '$datenow 08:00:00' and '$datenow 19:00:00' and color='#5499C7' 
                                        order by tbl_events.start_time ASC;");

                                    $res_data = mysqli_query($conn, $user_check_query) or die(mysqli_error($conn));
                                    while ($rowi = mysqli_fetch_array($res_data)) {

                                        $starttime = $rowi['start_time'];
                                        $endtime = $rowi['end_time'];
                                        $start = date("M jS, Y H:i:s", strtotime($starttime));
                                        $end = date(" H:i:s", strtotime($endtime));
                                        $i++;
                                ?>

                                        <input type="hidden" id="eid" name="eid" value="<?php echo $rowi["eventid"]; ?>">

                                        <h1 class="jobname title mt-3">Applicant : <?php echo $rowi['fname']; ?>
                                            <?php echo $rowi['lname']; ?></h1>

                                        <h2 class="subtitle">Scheduled Time (<?php echo $start; ?> <?php echo $end; ?>)</br>
                                            Applying for <?php echo $rowi["jobname"]; ?> |
                                            <?php echo $rowi["jobtype"]; ?> | <?php echo $rowi["joblocation"]; ?></h2>

                                        <a onclick='eventattended("<?php echo $rowi["fname"]; ?> <?php echo $rowi["lname"]; ?>","<?php echo $rowi["eventid"]; ?>")' class='attend button is-primary'>Present</a>
                                        <a onclick='eventnotattended("<?php echo $rowi["fname"]; ?> <?php echo $rowi["lname"]; ?>","<?php echo $rowi["eventid"]; ?>")' class="button is-light">Absent</a>
                                        <a href="scheduletodayviewapplication.php?appid=<?php echo $rowi["appid"]; ?>" class="button is-light">More Info</a>
                                        <div class="is-divider"></div>
                                    <?php
                                    }
                                    ?>
                                <?php
                                }
                                if ($badgeappointmentstoday == '0') {
                                ?>
                                    <div class="card is-shadowless">
                                        <h1 class="title">
                                            No Appointments For Today
                                        </h1>
                                        <h6>
                                            Tip: Set your appointments > Schedule Section
                                        </h6>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include '../webpages/scripttags.php'; ?>
</body>

</html>



<script>
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

    function eventnotattended(name, id) {
        var id1 = id;
        var name1 = name;

        Swal.fire({
            title: 'Are you sure? ',
            text: "This will be recorded as absent",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '../phpactions/notattendaction.php',
                    data: {
                        id: id1
                    },
                    type: "POST",
                    success: function(data) {

                        Swal.fire({
                                icon: 'success',
                                title: 'Successfully Recorded',
                            }),
                            setTimeout(function() {
                                parent.window.location.reload();
                            }, 1000);

                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error has been occur',
                        })
                    }
                });

            }
        })
    }

    function eventattended(name, id) {
        var id1 = id;
        var name1 = name;

        Swal.fire({
            title: 'Did ' + name1 + ' come? ',
            text: "This will be recorded as attended",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Not Yet'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '../phpactions/attendaction.php',
                    data: {
                        id: id1
                    },
                    type: "POST",
                    success: function(data) {

                        Swal.fire({
                                icon: 'success',
                                title: 'Successfully Recorded',
                            }),
                            setTimeout(function() {
                                parent.window.location.reload();
                            }, 1000);

                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error has been occur',
                        })
                    }
                });

            }
        })
    }
</script>