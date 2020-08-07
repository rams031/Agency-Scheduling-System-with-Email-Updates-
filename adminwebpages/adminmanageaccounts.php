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
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
                <div id="asidenavdivider" class="is-divider-vertical"></div>
                <div class="column is-9">
                    <div class="animate__animated animate__fadeInDown">
                        <table id="Accountstable" class="table table-bordered table-striped" cellspacing="2" width="100%">
                            <thead>
                                <tr style="font-family: 'PT Sans Narrow', sans-serif">
                                    <th>Applicant Name</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th>Date Registered</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = ("SELECT 
                                    * 
                                    FROM 
                                    tbl_user");

                                $set = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($set)) {
                                ?>
                                    <input id="jobid" type="hidden" value="<?php echo $row["userid"]; ?>">
                                    <tr>
                                        <td><?php echo $row["username"]; ?> <?php echo $row["userlastname"]; ?></td>
                                        <td><?php echo $row["useremail"]; ?></td>
                                        <td><?php echo $row["usertype"]; ?></td>
                                        <td><?php echo $row["datecreated"]; ?></td>
                                        <td>
                                            <a href='admineditaccount.php?uid=<?php echo $row["userid"]; ?>' class="button is-light">
                                                Edit
                                            </a>
                                            <a onclick='DeleteAccount(<?php echo $row["userid"]; ?>)' class="button is-light">
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
        $('#Accountstable').DataTable();
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

    function DeleteAccount(id) {

        var userid = id;

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete This Account'
        }).then((result) => {
            console.log(result)
            if (result.value) {
                $.ajax({
                    url: '../phpactions/accountdeleteaction.php',
                    method: 'POST',
                    data: {
                        userid: userid,
                    },
                    success: function(data) {
                        alert(data);
                        Swal.fire({
                                icon: 'success',
                                title: 'Account has been deleted.',
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
                            text: 'Please refresh the Browser',
                            timer: 1500
                        })
                    }

                })
            }
        })


    }
</script>