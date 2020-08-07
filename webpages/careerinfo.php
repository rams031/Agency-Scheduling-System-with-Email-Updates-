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
        <div data-aos="fade-in" class="section">
            <nav class="breadcrumb is-small" aria-label="breadcrumbs">
                <ul>
                    <li><a href="homepage.php">Home</a></li>
                    <li class="is-active"><a href="#">Career Information</a></li>
                </ul>
            </nav>
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
                $halfsalary = $row["jobsalary"] / 2;
            ?>
                <div class="card is-shadowless">
                    <div class="card-content">
                        <p id="title" class="jobname title is-size-2 ">
                            <?php echo $row["jobname"]; ?>
                        </p>
                        <p class="tag title is-size-5">
                            <?php echo $row["joblocation"]; ?> - <?php echo $row["jobtype"]; ?>
                        </p>
                        <p class="title is-size-3">
                            Salary:
                        </p>
                        <?php
                        if ($row["jobsalary"]) {
                        ?>
                            <p> Salary range from
                                <a style="color:green; font-weight:600"> ₱<?php echo $halfsalary; ?> </a>
                                /mo to <a style="color:green; font-weight:600"> ₱ <?php echo $row["jobsalary"]; ?> </a>
                                /mo dependingon <br> experience and qualifications.
                            </p>
                        <?php
                        } else {
                        ?>
                            <p>
                                (Not available for now)
                            </p>
                        <?php
                        }
                        ?>
                        <div class="is-divider"></div>
                        <div class="columns">
                            <div class="column">
                                <a id="title" class="title is-size-4">
                                    Industry:
                                </a>
                                <p>
                                    <?php echo $row["jobindustry"]; ?>
                                </p>
                            </div>
                            <div class="is-divider-vertical"></div>
                            <div class="column">
                                <a id="title" class="title is-size-4">
                                    Educational Attainment:
                                </a>
                                <p>
                                    <?php echo $row["jobeduclvl"]; ?>
                                </p>
                            </div>
                        </div>
                        <div class="is-divider"></div>
                        <div class="columns">
                            <div class="column">
                                <a id="title" class="title is-size-4">
                                    Experience Level:
                                </a>
                                <p>
                                    <?php echo $row["exp"]; ?>
                                </p>
                            </div>
                            <div class="is-divider-vertical"></div>
                            <div class="column">
                                <a id="title" class="title is-size-4">Company Address:</a>
                                <?php
                                if ($row["jobaddress"]) {
                                ?>
                                    <p>
                                        <?php echo $row["jobaddress"]; ?>
                                    </p>
                                <?php
                                } else {
                                ?>
                                    <p>
                                        (Not available for now)
                                    </p>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="is-divider"></div>
                        <a id="title" class="title is-size-4">
                            Job Description:
                        </a>
                        <p class="">
                            <?php echo $row["jobdescription"]; ?>
                        </p>

                        <div id="titles" class="field is-grouped is-grouped-right">
                            <p class="control">
                                <a class="button is-light mt-5" href="careerapply.php?id=<?php echo $row["jobid"]; ?>">
                                    Apply now
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                </li>
            <?php
            }
            ?>
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
</script>