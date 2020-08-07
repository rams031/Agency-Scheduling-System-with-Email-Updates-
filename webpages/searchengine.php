<div class="card is-shadowless mt-6">
    <div id="test-list">
        <div class="card is-shadowless">
            <div class="card-content">
                <div class="field">
                    <label class="label">Search Job or Keywords</label>
                    <div class="control">
                        <input class="fuzzy-search input" id="listsearch" name="listsearch" type="text" placeholder="Search Job or Keywords ">
                    </div>
                </div>
            </div>
        </div>
        <ul class="list">
            <?php

            $sql =(
                "SELECT 
                * 
                FROM 
                tbl_job 
                ORDER BY 
                RAND()");

            $res_data = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($res_data)) {
            ?>
                <li data-location="<?php echo $row["joblocation"]; ?>">
                    <div class="card is-shadowless ">
                        <div class="card-content">
                            <span id="titles" class="jobname title"><?php echo $row["jobname"]; ?></span>
                            <?php if ($row["jobsalary"] > 0) {
                                echo '<p class="is-size-5" style="color:green; font-weight:bold">₱';
                                echo $row["jobsalary"];
                                echo '- Monthly </p>';
                            } else {
                                echo '<p style="color:green;">(Not Available)</p>';
                            }
                            ?>
                            <p class="location">
                                <?php echo $row["joblocation"]; ?>
                            </p>
                            <p class="jobindustry">
                                (<?php echo $row["jobtype"]; ?>)
                            </p>
                            <p class="jobtype" value="<?php echo $row["jobindustry"]; ?>"></p>
                            <p>
                                <?php echo $row["jobdescription"]; ?>
                                <a href="careerinfo.php?id=<?php echo $row["jobid"]; ?>" class="tag is-size-7">
                                    ...
                                </a>
                            </p>
                            <a class="button is-light mt-2" href="careerinfo.php?id=<?php echo $row["jobid"]; ?>">
                                <p id="titles">More Details</p>
                            </a>
                            <a class="button is-dark mt-2" href="careerapply.php?id=<?php echo $row["jobid"]; ?>">
                                <p id="titles">Apply now</p>
                            </a>
                        </div>
                        <div class="is-divider"></div>
                </li>
            <?php
            }
            ?>
        </ul>
        <div class="no-result">
            <div class="card is-shadowless">
                <div class="card-content ">
                    <span id="titles" class="title">Sorry, your search did not match any jobs</br></span>
                    <span class="subtitle">We suggest that you </br></span>
                    <span class="subtitle">Search with different keywords </span>
                </div>
            </div>
        </div>
        <ul id="titles" class="pagination"></ul>
    </div>
</div>