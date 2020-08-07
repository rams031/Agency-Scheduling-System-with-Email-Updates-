<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../webpages/csstags.php'; ?>
</head>

<body>
    <section class="hero is-light is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-5-tablet is-4-desktop is-3-widescreen">
                        <figure id="logoimg" class="image is-128x128 " style="margin:auto; padding:10px;">
                            <img class="is-rounded is-centered" src="../assets/images/logoforweb.png">
                        </figure>
                        <form action="" class="box">
                            <p id="titles" class="title is-size-5">
                                Scheduling System Log-In
                            </p>
                            <div class="field">
                                <label for="" class="label">Email</label>
                                <input type="email" id="email" name="email" class="validate input" placeholder="Email Address" required>
                            </div>
                            <div class="field">
                                <label for="" class="label">Password</label>
                                <input type="password" id="pass" name="pass" class="validate input" placeholder="Password" required>
                            </div>
                            <div class="field is-grouped is-grouped-right">
                                <p class="control">
                                    <a id="login" class="submitBtn button is-light mt-3" >Log-in</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?php include '../webpages/scripttags.php'; ?>
</html>

<script>
    $(document).ready(function() {
        $("#login").click(function() {
            var email = $("#email").val();
            var pass = $("#pass").val();

            if (email != "" && pass != "") {
                if (email != "") {
                    $.ajax({
                        url: '../phpactions/loginaction.php',
                        method: 'POST',
                        data: {
                            email: email,
                            pass: pass
                        },
                        success: function(data) {
                            var result = JSON.parse(data);
                            if (result == 'admin') {
                                Swal.fire({
                                        icon: 'success',
                                        title: 'Welcome Admin',
                                    }),
                                    setTimeout(function() {
                                        top.location.href = "adminportal.php"
                                    }, 1000);

                            } else if (result == 'hrstaff') {
                                Swal.fire({
                                        icon: 'success',
                                        title: 'Welcome HR Staff',
                                    }),
                                    setTimeout(function() {
                                        top.location.href = "hrportal.php"
                                    }, 1000);

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    text: 'Make sure that email is the correct format, The combination you entered is not recognized or does not exist. Please try again.',
                                })
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Please Complete your Email Address ',
                    })
                }

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Complete Fillup Form ',
                })
            }
        });
    });
</script>