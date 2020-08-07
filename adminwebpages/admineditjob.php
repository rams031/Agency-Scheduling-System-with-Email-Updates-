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
                        <div class="backbutton">
                            <nav class="breadcrumb is-small" aria-label="breadcrumbs">
                                <ul>
                                    <li><a href="adminmanagejob.php">Manage job</a></li>
                                    <li class="is-active"><a href="#">Job Edit Information</a></li>
                                </ul>
                            </nav>
                        </div>
                        <form>
                            <?php include '../phpactions/jobdata.php' ?>
                            <input type="hidden" value="<?php echo $jobid; ?>" id="jobid">
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <label>Job Name</label>
                                        <div class="control">
                                            <input class="input form-control" type="text" value="<?php echo $jobname ?>" id="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="field">
                                        <label>Job Industry</label>
                                        <div class="control">
                                            <input class="input form-control" type="text" value="<?php echo $jobindustry ?>" id="industry">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <label>Salary (Optional)</label>
                                        <div class="control">
                                            <input id="salary" class="input form-control" type="text" value="<?php echo $jobsalary ?>" maxlength="10">
                                        </div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="field">
                                        <label>Experience Level</label>
                                        <div class="control">
                                            <input id="exp" class="input form-control" type="text" value="<?php echo $exp ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <label for="text">Educational Attainment</label>
                                        <div class="control">
                                            <input id="educ" class="input form-control" type="text" value="<?php echo $jobeduclvl ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="column selectedit">
                                    <div class="field">
                                        <label>Job Type</label>
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select id="type">
                                                    <?php
                                                    if ($jobtype == 'Full Time') {
                                                        echo '<option value="Full Time">Full Time</option>';
                                                        echo '<option value="Part Time">Part Time</option>';
                                                    } elseif ($jobtype == 'Part Time') {
                                                        echo '<option value="Part Time">Part Time</option>';
                                                        echo '<option value="Full Time">Full Time</option>';
                                                    } else {
                                                        echo '<option value=""disabled selected>Choose Job Type</option>';
                                                        echo '<option value="Part Time">Part Time</option>';
                                                        echo '<option value="Full Time">Full Time</option>';
                                                    }
                                                    ?>
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
                                                    <?php
                                                    if ($joblocation == 'Caloocan') {
                                                        echo '<option value="Caloocan">Caloocan</option>;';
                                                        echo '<option value="Valenzuela">Valenzuela</option>';
                                                        echo '<option value="Malabon">Malabon</option>';
                                                    } elseif ($joblocation == 'Valenzuela') {
                                                        echo '<option value="Valenzuela">Valenzuela</option>';
                                                        echo '<option value="Caloocan">Caloocan</option>;';
                                                        echo '<option value="Malabon">Malabon</option>';
                                                    } elseif ($jobeduclvl == 'Malabon') {
                                                        echo '<option value="Valenzuela">Malabon</option>';
                                                        echo '<option value="Caloocan">Caloocan</option>;';
                                                        echo '<option value="Valenzuela">Valenzuela</option>';
                                                    } else {

                                                        echo '<option value="" disabled selected >Choose Location</option>';
                                                        echo '<option value="Valenzuela">Valenzuela</option>';
                                                        echo '<option value="Caloocan">Caloocan</option>;';
                                                        echo '<option value="Malabon">Malabon</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>Job or Company Address (Optional) </label>
                                <div class="control">
                                    <input id="address" class="input" type="text" value="<?php echo $jobaddress ?>" placeholder="(Optional)">
                                </div>
                            </div>
                            <div class="field">
                                <label>Job Description</label>
                                <div class="control">
                                    <textarea id="desc" class="textarea" placeholder="Textarea" value="<?php echo $jobdescription ?>"><?php echo $jobdescription ?></textarea>
                                </div>
                            </div>
                            <div class="field is-grouped is-grouped-right">
                                <p class="control">
                                    <a type="submit" id="Applybutton" class="button is-light style=">Apply</a>
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
        $("#Applybutton").click(function() {
            var jobid = $("#jobid").val();
            var jobname = $("#name").val();
            var jobtype = $("#type").val();
            var jobindustry = $("#industry").val();
            var jobslot = $("#slot").val();
            var explvl = $("#exp").val();
            var educattain = $("#educ").val();
            var jobdesc = $("#desc").val();
            var salary = $("#salary").val();
            var location = $("#location").val();
            var address = $("#address").val();

            if (jobname != "" && jobtype != "" && jobindustry != "" &&
                jobslot != "" && explvl != "" && educattain != "" && jobdesc != "" &&
                location != "") {

                $.ajax({
                    url: '../phpactions/editjobaction.php',
                    method: 'POST',
                    data: {
                        jobid: jobid,
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
                        Swal.fire({
                                icon: 'success',
                                title: 'Successful',
                                title: 'Job Update Success',
                                timer: 3000
                            }),
                            setTimeout(function() {
                                top.location.href = "adminmanagejob.php"
                            }, 1000);

                    },
                    error: function(err) {
                        Swal.fire({
                            type: 'error',
                            title: 'Already in the list',
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