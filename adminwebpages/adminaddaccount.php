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
                                            <ul>
                                                <li>
                                                    <a class="activebox" href="adminaddaccount.php">Add New Account</a>
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
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
                <div id="asidenavdivider" class="is-divider-vertical"></div>
                <div class="column is-9">
                    <div class="animate__animated animate__fadeInDown">
                        <h1 id="titles" class="tag">Create New Account</h1>
                        <form>
                            <div class="field">
                                <label>User Name</label>
                                <div class="control">
                                    <input id="name" class="input form-control" type="text" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="field">
                                <label>User Last Name</label>
                                <div class="control">
                                    <input id="lastname" class="input form-control" type="text" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="field">
                                <label>User Email</label>
                                <div class="control">
                                    <input id="email" class="input form-control" type="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="field">
                                <label>User Password</label>
                                <div class="control">
                                    <input id="password" class="input form-control" type="text" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <label>User Contact</label>
                                        <div class="control">
                                            <input id="contacts" class="input form-control" type="number" placeholder="Contact Number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="column selectedit">
                                    <div class="field">
                                        <label>Job Type</label>
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select id="usertype" required>
                                                    <option value="" disabled selected>Choose Job Type</option>
                                                    <option value="hrstaff">Human Resource Staff</option>
                                                    <option value="admin">Administrator</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field is-grouped is-grouped-right">
                                <p class="control">
                                    <a type="submit" id="SaveAccount" class="button is-light">Save</a>
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
        $("#SaveAccount").click(function() {
            var username = $("#name").val();
            var userlastname = $("#lastname").val();
            var useremail = $("#email").val();
            var userpassword = $("#password").val();
            var contacts = $("#contacts").val();
            var usertype = $("#usertype").val();


            if (username != "" && username != "" && userlastname != "" &&
                useremail != "" && userpassword != "" && contacts != "") {

                $.ajax({
                    url: '../phpactions/addaccountaction.php',
                    method: 'POST',
                    data: {
                        username: username,
                        userlastname: userlastname,
                        useremail: useremail,
                        userpassword: userpassword,
                        usertype: usertype,
                        contacts: contacts
                    },
                    success: function(data) {

                        alert(data);
                        Swal.fire({
                                icon: 'success',
                                title: 'Successful',
                                text: 'New account has been added',
                                timer: 3000
                            }),
                            setTimeout(function() {
                                top.location.href = "adminmanageaccounts.php"
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