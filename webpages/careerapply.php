<?php include '../database/dbsql.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'csstags.php'; ?>
</head>

<body>
    <nav class="parallax-window" data-parallax="scroll" data-image-src="../assets/images/career4.png">
        <?php include "navbar.php" ?>
    </nav>
    <div class="container is-fullhd">
        <div class="section">
            <nav class="breadcrumb is-small" aria-label="breadcrumbs">
                <ul>
                    <li><a href="homepage.php">Home</a></li>
                    <li class="is-active"><a href="#">Career Application</a></li>
                </ul>
            </nav>
        </div>
        <div data-aos="fade-in" class="section">
            <div class="columns">
                <div class="column is-one-third">
                    <div class="card is-shadowless">
                        <div class="card-content">
                            <?php
                            $jobid = $_GET['id'];

                            $user_check_query = (
                                "SELECT 
                                * 
                                FROM 
                                tbl_job
                                WHERE 
                                jobid='$jobid' 
                                limit 1");

                            $res_data = mysqli_query($conn, $user_check_query) or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($res_data)) {
                            ?>
                                <p id="titles" class="title is-size-2">
                                    <?php echo $row["jobname"]; ?>
                                    <p>
                                        <p id="titles" class=" is-size-5">
                                            Company Industry
                                        </p>
                                        <p class="light">
                                            <?php echo $row["jobindustry"]; ?>
                                        </p>

                                        <p id="titles" class=" is-size-5 mt-3">Location</p>

                                        <p class="light  ">
                                            <?php echo $row["joblocation"]; ?>
                                        </p>

                                        <p id="titles" class=" is-size-5 mt-3">
                                            Job Type
                                        </p>
                                        <p>
                                            <?php echo $row["jobtype"]; ?>
                                        </p>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="is-divider-vertical"></div>
                <div class="column is-centered">
                    <?php include 'applicationform.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'scripttags.php'; ?>
</body>
<?php include 'footer.php'; ?>

</html>


<script>
    AOS.init({
        duration: 500,
    });

    $(document).ready(function() {
        $("#file").change(function() {
            var file = this.files[0];
            var filename = file.name;
            var ext = filename.split('.').pop().toLowerCase();
            if (jQuery.inArray(ext, ['docx', 'pdf', 'png', 'jpg', 'jpeg']) == -1) {
                Swal.fire({
                    icon: 'question',
                    title: 'Only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.',
                })
                $("#file").val('');
                return false;
            }
        });

        $("#fupForm").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: '../phpactions/applicationsubmit.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('.submitBtn').attr("disabled", "disabled");
                    $('#fupForm').css("opacity", ".5");
                },
                success: function(data) {
                    Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Your Application has been process please wait for text or email for schedule',
                        }),
                        setTimeout(function() {
                            top.location.href = "homepage.php"
                        }, 3000);
                },
                error: function(err) {
                    alert(err);
                    $(".submitBtn").removeAttr("disabled");
                    $('#fupForm').css("opacity", ".5");
                    Swal.fire({
                        icon: 'error',
                        title: 'There is a error . Please refresh the page',
                        timer: 1500
                    })
                }
            });
        });
    });
</script>