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
                                            <a href="adminmanagejob.php">
                                                Manage Jobs
                                            </a>
                                            <ul>
                                                <li class="activebox"><a href="adminaddjob.php">Add New Job</a></li>
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
                        <h1 id="titles" class="tag">Create New Job</h1>
                        <form>
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <label>Job Name</label>
                                        <div class="control">
                                            <input id="jobname" class="input form-control" type="text" placeholder="Job Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="field">
                                        <label>Job Industry</label>
                                        <div class="control">
                                            <input id="jobindustry" class="input form-control" type="text" placeholder="Job Industry">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <label>Salary (Optional)</label>
                                        <div class="control">
                                            <input id="salary" class="input form-control" type="text" maxlength="10" placeholder="(Optional)">
                                        </div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="field">
                                        <label>Experience Level</label>
                                        <div class="control">
                                            <input id="exp" class="input form-control" type="text" placeholder="Experience Level">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <label for="text">Educational Attainment</label>
                                        <div class="control">
                                            <input id="educattain" class="input form-control" type="text" placeholder="Educational Attainment">
                                        </div>
                                    </div>
                                </div>
                                <div class="column selectedit">
                                    <div class="field">
                                        <label>Job Type</label>
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select id="jobtype">

                                                    <option value="" disabled selected>Choose Job Type</option>
                                                    <option value="Part Time">Part Time</option>
                                                    <option value="Full Time">Full Time</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column selectedit">
                                    <div class="field">
                                        <label>Location</label>
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select id="location">
                                                    <option value="" disabled selected>Choose Location</option>
                                                    <option value="Valenzuela">Valenzuela</option>
                                                    <option value="Caloocan">Caloocan</option>
                                                    <option value="Malabon">Malabon</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>Job or Company Address (Optional) </label>
                                <div class="control">
                                    <input id="address" class="input" type="text" placeholder="(Optional)">
                                </div>
                            </div>
                            <div class="field">
                                <label>Job Description</label>
                                <div class="control">
                                    <textarea id="jobdesc" class="textarea" placeholder="Job Description"></textarea>
                                </div>

                            </div>
                            <div class="field is-grouped is-grouped-right">
                                <p class="control">
                                    <a type="submit" id="Savebutton" class="button is-light">Save</a>
                                </p>
                            </div>
                        </form>
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
        $("#Savebutton").click(function() {
            var jobname = $("#jobname").val();
            var jobtype = $("#jobtype").val();
            var jobindustry = $("#jobindustry").val();
            var salary = $("#salary").val();
            var location = $("#location").val();
            var explvl = $("#exp").val();
            var educattain = $("#educattain").val();
            var jobdesc = $("#jobdesc").val();
            var address = $("#address").val();

            if (jobname != "" && jobtype != "" && jobindustry != "" &&
                location != "" && explvl != "" && educattain != "" && jobdesc != ""
            ) {

                $.ajax({
                    url: '../phpactions/addjobaction.php',
                    method: 'POST',
                    data: {
                        jobname: jobname,
                        jobindustry: jobindustry,
                        jobtype: jobtype,
                        salary: salary,
                        location: location,
                        explvl: explvl,
                        educattain: educattain,
                        jobdesc: jobdesc,
                        address: address
                    },
                    success: function(data) {
                        alert(data);
                        if (data === "Already in Job List") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Job is already in the list',
                                timer: 1500
                            })
                        } else {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Successful',
                                    title: 'Job Added',
                                    timer: 1500
                                }),
                                setTimeout(function() {
                                    top.location.href = "adminaddjob.php"
                                }, 1000);

                        }
                    },
                    error: function(err) {
                        Swal.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'There is error on server , Please refresh',
                            timer: 1500
                        })
                    }
                });

            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Complete Fillup Form ',
                })
            }
        });

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