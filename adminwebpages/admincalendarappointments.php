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
                                            <a href="adminportal.php">
                                                Dashboard
                                            </a>
                                        </li>
                                        <p class="menu-label">
                                            Appointments
                                        </p>
                                        <li class="activebox">
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
                    <div class="animate__animated animate__fadeInDown mx-5" id='calendar'></div>
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
            <p class="modal-card-title">Event</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <div class="title">
                <p type="text" id="color" name="color">
            </div>
            <div>
                <input type="hidden" id="start" name="start" class="validate">
            </div>
            <div>
                <input type="hidden" id="end" name="end" class="validate">
            </div>
            <div class="subtitle">
                <p><strong>Scheduled Time :</strong></p>
                <p type="text" id="time" name="time">
            </div>
            <div class="subtitle">
                <p><strong>Applicant :</strong>
                    <p>
                        <p type="text" id="applicant" name="applicant">
            </div>
            <div class="subtitle">
                <p><strong>Applying for :</strong>
                    <p>
                        <p type="text" id="applyingfor" name="applyingfor">
            </div>
            <div class="subtitle">
                <p><strong>Scheduled by </strong>
                    <p>
                        <p type="text" id="hrinfo" name="hrinfo">
            </div>
            <div class="subtitle reminderto">
                <p><strong>Reminder:</strong>
                    <p>
                        <p type="text" id="reminder" name="reminder">
            </div>
            <div class="field is-grouped is-grouped-right">
                <p class="control">
                    <button type="submit " id="button1" name="button1" class="button is-light" value="Reschedule"><strong>Reschedule</strong>
                </p>
            </div>
            <input type="hidden" id="schedid" name="schedid">
            <input type="hidden" id="eventid" name="eventid">
        </section>
    </div>
</div>

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

        $(".delete").click(function() {
            $(".modal").removeClass("is-active")

        });

        $('#button1').on('click', function() {
            var sid = $("#schedid").val();
            var eid = $("#eventid").val();
            $.ajax({
                method: 'POST',
                url: '../phpactions/rescheduleaction.php',
                data: {
                    eid: eid,
                    sid: sid,
                },
                success: function(data) {
                    Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Event has been moved to HR Schedule Section',
                        }),
                        setTimeout(function() {
                            top.location.href = "admincalendarappointments.php"
                        }, 3000);


                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Unsuccessful',
                        text: 'There has been problem inserting data',
                    });
                }
            });
        });
    });


    var calendar = $('#calendar').fullCalendar({

        contentHeight: 550,
        events: '../phpactions/eventrender.php',
        minTime: "08:00:00",
        maxTime: "19:00:00",

        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaDay'
        },

        eventRender: function(event, element, view) {
            $(element).css("font-weight", "bold");
            $(element).css("font-size", "13px");

        },



        height: 900,
        selectable: false,
        eventBorderColor: '#08c',
        editable: false,
        allDaySlot: false,


        eventClick: function(event) {




            var name = event.fname + ' ' + event.lname;
            var hrname = 'HR Staff :' + ' ' + event.username + ' ' + event.userlastname;
            var job = event.jobname;
            var upcoming = "Upcoming Event";
            var failed = "Failed To Attend";
            var success = "Have Attended";
            var color = event.color;
            var reminder = event.rem;
            var sid = event.schedid;
            var eid = event.eventid;

            if (event.color == "#5499C7") {
                $('.modal #color').html(upcoming);
                $('#button2').show();
                $('#button1').show();

            } else if (event.color == "#DD3030") {
                $('.modal #color').html(failed);
                $('#button1').show();
            } else {
                $('.modal #color').html(success);
                $('#button1').hide();
            }



            endtime = $.fullCalendar.moment(event.end).format('h:mm');
            starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');


            var mywhen = starttime + ' - ' + endtime;
            start = moment(starttime).format();
            end = moment(endtime).format();

            if (reminder == '') {
                $('.reminderto').hide();
            }

            $('.modal #time').html(mywhen);
            $('.modal #applyingfor').html(job);
            $('.modal #hrinfo').html(hrname);
            $('.modal #applicant').html(name);
            $('.modal #start').val(start);
            $('.modal #reminder').html(reminder);
            $('.modal #schedid').val(sid);
            $('.modal #eventid').val(eid);
            $('.modal #end').val(end);


            $('.modal').addClass("is-active");


        },

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


        businessHours: {
            hiddenDays: [7],
            dow: [1, 2, 3, 4, 5, 6],
            start: '8:00',
            end: '19:00',

        }


    });
</script>