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
    <?php include '../phpactions/dashboarddata.php'; ?>
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
                                            <a href="adminportal.php">
                                                Dashboard
                                            </a>
                                        </li>
                                        <p class="menu-label">
                                            Appointments
                                        </p>
                                        <li>
                                            <a href="admincalendarappointments.php">
                                                Scheduled Appointments
                                            </a>
                                        </li>
                                        <p class="menu-label">
                                            Manage
                                        </p>
                                        <li>
                                            <a class="activebox" href="adminmanagejob.php">
                                                Manage Jobs
                                            </a>
                                            <ul>
                                                <li><a href="adminaddjob.php">Add New Job</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="adminmanageaccounts.php">
                                                Manage Accounts
                                            </a>
                                        </li>
                                        <li>
                                            <a href="adminmanageemailaccount.php">
                                                Manage Email
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
                        <table id="jobtable" class="table table-bordered table-striped" cellspacing="2" width="100%">
                            <thead>
                                <tr style="font-family: 'PT Sans Narrow', sans-serif">
                                    <th color="red">Job Name</th>
                                    <th>Industry</th>
                                    <th>Job Type</th>
                                    <th>Location</th>
                                    <th>Education</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $sql = ("SELECT 
                                    * 
                                    FROM 
                                    tbl_job");

                                $set = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($set)) {
                                ?>
                                    <input type="hidden" value="<?php echo $row["jobid"]; ?>" id="jobid">
                                    <tr>
                                        <td><?php echo $row["jobname"]; ?></td>
                                        <td><?php echo $row["jobindustry"]; ?></td>
                                        <td><?php echo $row["jobtype"]; ?></td>
                                        <td><?php echo $row["joblocation"]; ?></td>
                                        <td><?php echo $row["jobeduclvl"]; ?></td>
                                        <td>
                                            <a href='admineditjob.php?jid=<?php echo $row["jobid"]; ?>' class="button is-light">
                                                edit
                                            </a>
                                            <a onclick=confirmDelete(<?php echo $row["jobid"]; ?>) class="button is-light">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
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
    $(document).ready(function() {
        $('#jobtable').DataTable();
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

    function confirmDelete(id) {

        var jobid = id;

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '../phpactions/jobdeleteaction.php',
                    method: 'POST',
                    data: {
                        jobid: jobid,
                    },

                    success: function(data) {
                        Swal.fire({
                                icon: 'success',
                                title: 'Job has been deleted.',
                                timer: 3000
                            }),
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                    },
                    error: function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'There is Error',
                            timer: 1500
                        })
                    }
                })
            }
        })
    }
</script>