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
                    <div class="rightbody animate__animated animate__fadeInDown">
                        <div class="backbutton">
                            <nav class="breadcrumb is-small" aria-label="breadcrumbs">
                                <ul>
                                    <li><a href="hrportal.php">Job Applications</a></li>
                                    <li class="is-active"><a href="#">Applicant Information</a></li>
                                </ul>
                            </nav>
                        </div>

                        <?php
                        $app = $_GET['appid'];
                        $user_check_query = ("SELECT 
                            * 
                            FROM 
                            tbl_job 
                            LEFT JOIN tbl_application ON tbl_application.jobid = tbl_job.jobid 
                            WHERE 
                            tbl_application.appid = '$app' ;");

                        $res_data = mysqli_query($conn, $user_check_query) or die(mysqli_error($conn));
                        while ($row = mysqli_fetch_array($res_data)) {
                        ?>

                            <div class="card is-shadowless mt-5">
                                <div id="titles" class="title">
                                    Applying for <?php echo $row["jobname"]; ?>
                                </div>
                                <div id="titles" class="tag subtitle is-size-6">
                                    <?php echo $row["joblocation"]; ?> -
                                    <?php echo $row["jobtype"]; ?>
                                </div>
                                <div id="titles" class="subtitle">
                                    Personal Information
                                </div>
                                <div id="titles">
                                    Name: <?php echo $row["fname"]; ?>
                                    <?php echo $row["lname"]; ?>
                                    <p>Email: <?php echo $row["email"]; ?></p>
                                    <p>Contact: <?php echo $row["contact"]; ?></p>
                                    <p>Age: <?php echo $row["age"]; ?></p>
                                    <p>Gender: <?php echo $row["gender"]; ?></p>
                                    <p>Address: <?php echo $row["address"]; ?></p>
                                </div>
                                <div id="titles" class="mt-5">
                                    Attachment
                                </div>
                                <a id="GetFile" class="mt-5" style="cursor: pointer;"><?php echo basename($row["imgid"]) ?></a>
                                <p class="is-size-7 mt-3">Kindly click the file to download. <br>It is validated as a
                                    pdf and word document</p>
                                <input type="hidden" id="url" name="url" value="<?php echo $row["imgid"]; ?>">
                                <input type="hidden" id="urlname" name="urlname" value="<?php echo basename($row["imgid"]) ?>">
                                <div class="field is-grouped is-grouped-right">
                                    <p class="control">
                                        <button id="schedulebutton" class="button is-light " type="button" name="action">
                                            <p id="titles">Save to Schedule Section<p>
                                        </button>
                                    </p>
                                </div>
                                <input type="hidden" id="userid" name="userid" value="<?php echo $_SESSION["userid"]; ?>">
                                <input type="hidden" id="appid" name="appid" value="<?php echo $row["appid"]; ?>">
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../webpages/scripttags.php'; ?>
</body>

</html>

<script type="text/javascript">
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

        $('#GetFile').on('click', function() {
            var urlfile = $("#url").val();
            var urlname = $("#urlname").val();
            var ext = urlname.split('.').pop().toLowerCase();

            $.ajax({
                url: urlfile,
                method: 'GET',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(data) {
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                    a.href = url;
                    a.download = urlname;
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                }
            });
        });

        $('#schedulebutton').on('click', function() {
            var appid = $("#appid").val();
            var userid = $("#userid").val();
            $.ajax({
                method: 'POST',
                url: '../phpactions/scheduleaction.php',
                data: {
                    appid: appid,
                    userid: userid
                },
                success: function(data) {
                    Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Schedule has been moved to schedule section',
                            showCancelButton: false,
                            showConfirmButton: false,
                        }),
                        setTimeout(function() {
                            top.location.href = "../adminwebpages/hrportal.php"
                        }, 2000);

                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Unsuccessful',
                        showCancelButton: false,
                        showConfirmButton: false,
                        text: 'There has been problem inserting data',
                    });

                }
            });
        });
    });
</script>