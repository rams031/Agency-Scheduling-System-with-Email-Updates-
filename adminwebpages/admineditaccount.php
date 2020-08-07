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
                                            <a class="activebox" href="adminmanageaccounts.php">
                                                Manage Accounts
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="adminaddaccount.php">Add New Account</a>
                                                </li>
                                            </ul>
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
                                    <li><a href="adminmanageaccounts.php">Manage Account</a></li>
                                    <li class="is-active"><a href="#">Account Edit Information</a></li>
                                </ul>
                            </nav>
                        </div>
                        <form>
                            <?php include '../phpactions/accountsdata.php'; ?>
                            <input type="hidden" value="<?php echo $userid; ?>" id="userid">
                            <div class="field">
                                <label>User Name</label>
                                <div class="control">
                                    <input id="name" class="input form-control" type="text" value="<?php echo $username; ?>">
                                </div>
                            </div>
                            <div class="field">
                                <label>User LastName</label>
                                <div class="control">
                                    <input id="lastname" class="input form-control" type="text" value="<?php echo $userlastname; ?>">
                                </div>
                            </div>
                            <div class="field">
                                <label>User Email</label>
                                <div class="control">
                                    <input id="email" class="input form-control" type="text" value="<?php echo $useremail; ?>">
                                </div>
                            </div>
                            <div class="field">
                                <label>User Password</label>
                                <div class="control">
                                    <input id="password" class="input form-control" type="text" value="<?php echo $userpassword; ?>">
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <label>User Contact</label>
                                        <div class="control">
                                            <input id="contacts" class="input form-control" type="text" value="<?php echo $contacts; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="column selectedit">
                                    <div class="field">
                                        <label>Location</label>
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select id="usertype">
                                                    <?php
                                                    if ($usertype == 'admin') {

                                                        echo '<option value="admin">Administrator</option>';
                                                        echo '<option value="hrstaff">Human Resource Staff </option>';
                                                    } elseif ($usertype == 'hrstaff') {
                                                        echo '<option value="hrstaff">Human Resource Staff</option>';
                                                        echo '<option value="admin">Administrator</option>';
                                                    } else {
                                                        echo '<option value=""disabled selected>Choose Job Type</option>';
                                                        echo '<option value="hrstaff">Human Resource Staff</option>';
                                                        echo '<option value="admin">Administrator</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field is-grouped is-grouped-right">
                                <p class="control">
                                    <a type="submit" id="EditAccount" class="button is-light">Apply</a>
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
        $("#EditAccount").click(function() {
            var userid = $("#userid").val();
            var username = $("#name").val();
            var userlastname = $("#lastname").val();
            var useremail = $("#email").val();
            var userpassword = $("#password").val();
            var contacts = $("#contacts").val();
            var usertype = $("#usertype").val();


            if (username != "" && username != "" && userlastname != "" &&
                useremail != "" && userpassword != "" && contacts != "") {

                $.ajax({
                    url: '../phpactions/edituseraction.php',
                    method: 'POST',
                    data: {
                        userid: userid,
                        username: username,
                        userlastname: userlastname,
                        useremail: useremail,
                        userpassword: userpassword,
                        usertype: usertype,
                        contacts: contacts

                    },

                    success: function(data) {


                        Swal.fire({
                                icon: 'success',
                                title: 'Successful',
                                text: 'User Information has been updated successfully',
                                timer: 3000
                            }),
                            setTimeout(function() {
                                top.location.href = "adminmanageaccount.php"
                            }, 1000);

                    },
                    error: function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'There is an error',
                            text: 'Please refresh the browser',
                            timer: 1500
                        })
                    }
                });

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
        $(".navbar-burger").click(function() {
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");

        });


    });
</script>