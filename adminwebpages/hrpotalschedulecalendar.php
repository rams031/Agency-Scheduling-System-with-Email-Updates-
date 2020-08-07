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
                                        <li class="activebox">
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
                        <div class="backbutton">
                            <nav class="breadcrumb is-small" aria-label="breadcrumbs">
                                <ul>
                                    <li><a href="hrportalschedulesection.php">Schedule Section</a></li>
                                    <li class="is-active"><a href="#">Schedule Appointment</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="notification mt-2">
                            <p class="reminder is-size-7">Reminder:
                                <strong>Click Date and Time</strong> to Schedule an event. </p>
                        </div>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../webpages/scripttags.php'; ?>
</body>

</html>

<div class="modal animate__animated animate__fadeIn">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Schedule Appointment</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <label>Schedule Time :</label>
            <p type="hidden" id="start" name="start" class="validate">
                <p type="hidden" id="end" name="end" class="validate">
                    <p type="text" id="time" name="time" class="title">
                        <?php
                        $sched = $_GET['schedid'];

                        $user_check_query = ("SELECT 
                            * 
                            FROM
                            tbl_forschedule 
                            INNER JOIN tbl_application ON tbl_application.appid = tbl_forschedule.appid 
			                INNER JOIN tbl_job ON tbl_application.jobid = tbl_job.jobid 
                            where 
                            tbl_forschedule.schedid = '$sched'");

                        $res_data = mysqli_query($conn, $user_check_query) or die(mysqli_error($conn));
                        while ($row = mysqli_fetch_array($res_data)) {
                        ?>

                            <div class="mt-2">
                                <label>Applicant :</label>
                                <p id="applicant" class="subtitle"><strong><?php echo $row["fname"]; ?>
                                        <?php echo $row["lname"]; ?></strong></p>
                            </div>
                            <div class="mt-2">
                                <label>Applying for :</label>
                                <p id="jobname" class="subtitle"><strong> <?php echo $row["jobname"]; ?></strong></>
                            </div>
                            <div class="mt-2">
                                <label>Applying for :</label>
                                <p id="emailnoo" class="subtitle">
                                    <strong> <?php echo $row["email"]; ?></strong></p>
                            </div>
                            <div>
                                <input type="hidden" id="title" value="Applicant : <?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?>" />
                            </div>
                            <div class="mt-2">
                                <label>Reminder(optional):</label>
                                <textarea id="reminder" class="textarea" placeholder="Reminder..." data-length="120"></textarea>
                            </div>
                            <p><small>after set schedule (automatically send details via email to applicant)</small></p>
                            <input type="hidden" id="schedid" name="schedid" value="<?php echo $row["schedid"]; ?>">

                        <?php
                        }
                        ?>

                        <div class="field is-grouped is-grouped-right mt-2">
                            <p class="control">
                                <a onclick="eventinsert()" class="button is-light ">Set Schedule</a>
                            </p>
                        </div>
        </section>
    </div>
</div>


<script>
    function eventinsert() {
        var myid = $('#myid').val();
        var reminder = $('#reminder').val();
        var time = $('#time').html();
        var start = $('#start').val();
        var end = $('#end').val();
        var schedid = $('#schedid').val();
        var title = $('#title').val();


        Swal.fire({
            title: '<strong>You wont able to revert this!</strong>',
            html: 'Scheduling this time will automatically </br> <b>(Send an Email to Applicant)</b>',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Schedule this time!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '../phpactions/validatecalendaraction.php',
                    data: {
                        start: start,
                        end: end
                    },
                    type: "POST",
                    success: function(data) {
                        var result = JSON.parse(data);
                        if (result == 'occupied') {
                            Swal.fire({
                                icon: 'error',
                                title: "You can't set more than one event at a time",
                                closeOnClickOutside: false,
                            })
                            $('.modal').modal('close');
                        } else {
                            $.ajax({
                                url: '../phpactions/emailaction.php',
                                data: {
                                    schedid: schedid,
                                    time: time
                                },
                                beforeSend: function() {
                                    let timerInterval
                                    Swal.fire({
                                        title: 'On Progress',
                                        html: '<strong>Please wait for a moment</strong>',
                                        timer: 5000,
                                        closeOnClickOutside: false,
                                        onBeforeOpen: () => {
                                            Swal.showLoading()
                                            timerInterval = setInterval(() => {
                                                Swal.getContent().querySelector('strong')
                                            }, 500)
                                        }
                                    });
                                },
                                type: "POST",
                                success: function(data) {
                                    let timerInterval
                                    Swal.fire({
                                        title: 'Sending Email',
                                        html: '<strong>Loading</strong>',
                                        timer: 3000,
                                        closeOnClickOutside: false,
                                        onBeforeOpen: () => {
                                            Swal.showLoading()
                                            timerInterval = setInterval(() => {
                                                Swal.getContent().querySelector('strong')
                                            }, 200)
                                        },
                                    }).then((result) => {
                                        $.ajax({
                                            url: '../phpactions/eventaction.php',
                                            data: {
                                                schedid: schedid,
                                                start: start,
                                                end: end,
                                                title: title,
                                                reminder: reminder
                                            },
                                            type: "POST",

                                            success: function(data) {
                                                Swal.fire({
                                                        icon: 'success',
                                                        title: 'Successfully sent email and scheduled',
                                                        closeOnClickOutside: false,
                                                    }),
                                                    setTimeout(function() {
                                                        top.location.href = "../adminwebpages/hrportalschedulesection.php"
                                                    }, 1000);

                                            },
                                            error: function() {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Email Address is not valid or Email Server is down',
                                                    text: 'Make sure (Email account for business) is saved on administrator portal'
                                                })
                                            }
                                        });
                                    })
                                },
                                error: function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Email Address is not valid or Email Server is down',
                                        text: 'Make sure (Email account for business) is saved on administrator portal'
                                    })
                                }
                            });
                        }
                    }
                });
            }
        })
    }
    $(document).ready(function() {
        $(".delete").click(function() {
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
            $(".modal").removeClass("is-active")
        });
    });

    var calendar = $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaDay'
        },

        contentHeight: 550,
        events: '../phpactions/eventrender.php',
        minTime: "08:00:00",
        maxTime: "19:00:00",
        selectable: true,
        eventBorderColor: '#08c',
        editable: false,
        allDaySlot: false,

        dayClick: function(date, jsEvent, view) {
            var checkDay = new Date(moment(date).format('YYYY/MM/DD'));
            if (checkDay.getDay() == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Weekend',
                })
            } else {
                $('#calendar').fullCalendar('gotoDate', date);
                $('#calendar').fullCalendar('changeView', 'agendaDay');
            }
        },

        select: function(start, end, jsEvent, view) {
            var selectedDate = moment(start).format('YYYY/MM/DD');
            var todayDate = moment().subtract(1, "days").format('YYYY/MM/DD');
            var viewname = view.name;
            if (selectedDate <= todayDate) {
                if (view.name == 'agendaDay') {

                    Swal.fire({
                        icon: 'error',
                        title: 'Cannot Schedule from past Dates',
                    })
                }
            } else {
                if (viewname == 'agendaDay') {
                    if (start.format("HH") < 08 || start.format("HH") > 18) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Please select a other time (8am  to 5pm Worktime) ',
                        })
                    } else {
                        endtime = $.fullCalendar.moment(end).format('h:mm');
                        starttime = $.fullCalendar.moment(start).format('dddd, MMMM Do YYYY, h:mm');
                        var mywhen = starttime + ' - ' + endtime;
                        start = moment(start).format();
                        end = moment(end).format();

                        $('.modal #start').val(start);
                        $('.modal #end').val(end);
                        $('.modal #time').html(mywhen);

                        $('.modal').addClass("is-active");

                    }
                }
            }
        },

        businessHours: {
            hiddenDays: [7],
            dow: [1, 2, 3, 4, 5, 6],
            start: '8:00',
            end: '19:00',

        }


    });
</script>