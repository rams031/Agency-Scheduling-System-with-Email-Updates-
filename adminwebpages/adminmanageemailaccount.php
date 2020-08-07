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
                                        </li>
                                        <li>
                                            <a href="adminmanageaccounts.php">
                                                Manage Accounts
                                            </a>
                                        </li>
                                        <li class="activebox">
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
                        <div class="columns">
                            <div class="column">
                                <div class="notification is-light">
                                    <button class="delete"></button>
                                    <h4 class="title">The purpose of this email account is to send an email to the candidate applicant </h4>
                                    <div class="remindernote">
                                        <strong>
                                            BEFORE CHANGING EMAIL ACCOUNT: <br>
                                            Follow Instructions for new account / failure to obey instruction may lead to error<br>
                                            or kindly contact developer for support.<br>
                                            Enabling less secure apps to access Gmail:
                                            Turning on 'less secure apps' settings as mail domain Administrator <br>
                                            1.Open your Google Admin console (admin.google.com).<br>
                                            2.Click Security > Basic settings.<br>
                                            3.Under Less secure apps, select Go to settings for less secure apps.<br>
                                            4.In the subwindow, select the Enforce access to less secure apps for all users radio button.<br>
                                            (You can also use the Allow users to manage their access to less secure apps, but don't forget to turn on the less secure apps option in users settings then!)
                                            Click the Save button.
                                        </strong>
                                    </div>
                                </div>

                                <?php
                                $user_check_query = ("SELECT 
                                    * 
                                    FROM 
                                    tbl_email");

                                $result = mysqli_query($conn, $user_check_query) or die(mysqli_error($conn));
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <h1 id="titles" class="tag">Email Account For Business</h1>
                                    <div class="field">
                                        <label>Email Address</label>
                                        <div class="control">
                                            <input id="email" class="input" type="text" value="<?php echo $row["email"]; ?>" placeholder="Email Address" required>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label>Email Password</label>
                                        <div class="control">
                                            <input id="emailpassword" class="input" type="text" value="<?php echo $row["password"]; ?>" placeholder="Email Password" required>
                                        </div>
                                    </div>

                                    <div class="field is-grouped is-grouped-right">
                                        <p class="control">
                                            <a type="submit" id="Saveemailaccountbutton" class="button is-light">Save and Apply Changes</a>
                                        </p>
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
    <?php include '../webpages/scripttags.php'; ?>
</body>

</html>

<script>
    $(document).ready(function() {
        $("#Saveemailaccountbutton").click(function() {
            var email = $("#email").val();
            var emailpass = $("#emailpassword").val();
            if (email != "" && emailpass != "") {


                Swal.fire({
                    title: 'Are you sure?',
                    text: "Make sure you follow the procedure.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: 'red',
                    cancelButtonColor: 'gray',
                    confirmButtonText: 'Change Email Account'

                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '../phpactions/admineditemailaction.php',
                            method: 'POST',
                            data: {
                                email: email,
                                emailpass: emailpass
                            },

                            success: function(data) {

                                Swal.fire({
                                        icon: 'success',
                                        title: 'Successful',
                                        title: 'User Information has been updated successfully',
                                        timer: 3000
                                    }),
                                    setTimeout(function() {
                                        top.location.href = "adminmanageemailaccount.php"
                                    }, 1000);

                            },
                            error: function(err) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Theres an error',
                                    timer: 1500
                                })
                            }
                        });
                    }
                })

            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Complete the Form ',
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

        $(".delete").click(function() {
            $(".notification").hide(300);
        });


        $(".navbar-burger").click(function() {
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");
        });
    });
</script>