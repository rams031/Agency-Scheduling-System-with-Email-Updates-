<div class="card is-shadowless">
    <div class="card-content">
        <div class="card-content blue-text">
            <p class="title is-size-3">Search Filter</p>
            <p class="subtitle is-size-5">Locations</p>
            <form>
                <p>
                    <label>
                        <input class="filter-all" id="location-all" name="location" value="all" type="radio" checked />
                        <?php

                        $sql =( 
                            "SELECT 
                            COUNT(jobid)
                            as 
                            maxnumber
                            FROM 
                            tbl_job");

                        $set = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($set)) {
                        ?>
                            <span>All (<?php echo $row["maxnumber"]; ?>) </span>
                        <?php
                        }
                        ?>
                    </label>
                </p>
                <?php

                $sql =(
                    "SELECT 
                    COUNT(jobid) 
                    as 
                    maxnumber, 
                    joblocation 
                    FROM 
                    tbl_job 
                    GROUP BY 
                    joblocation");

                $set = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($set)) {
                ?>
                    <p>
                        <label>
                            <input class="filter" type="radio" value="<?php echo $row["joblocation"]; ?>" name="location" id="location-<?php echo $row["joblocation"]; ?>" />
                            <span><?php echo $row["joblocation"]; ?> (<?php echo $row["maxnumber"]; ?>)</span>
                        </label>
                    </p>
                <?php
                }
                ?>
            </form>
            <div class="is-divider"></div>
            <p class="subtitle is-size-5">Job-Type</p>
            <form>
                <?php

                $sql =(
                    "SELECT 
                    COUNT(jobid) 
                    as 
                    maxnumber,  
                    jobtype 
                    FROM 
                    tbl_job 
                    GROUP BY 
                    jobtype ");

                $set = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($set)) {
                ?>
                    <p>
                        <label>
                            <input class="filter" id="jobind-<?php echo $row["jobtype"]; ?>" name="jobindustry" value="<?php echo $row["jobtype"]; ?>" type="radio" />
                            <span><?php echo $row["jobtype"]; ?>(<?php echo $row["maxnumber"]; ?>) </span>
                        </label>
                    </p>
                <?php
                }
                ?>
            </form>
            <div class="is-divider"></div>
            <p class="subtitle is-size-5">Top Industry</p>
            <form action="#" class="center-align" style="margin-bottom:10px ;">
                <?php
                $topnumber = 1;

                $sql = (
                    "SELECT 
                    COUNT(jobid) 
                    as 
                    maxnumber,
                    jobindustry
                    FROM 
                    tbl_job 
                    GROUP BY  
                    jobindustry 
                    limit 5");

                $set = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($set)) {
                ?>
                    <p>
                        <label>

                            <span><?php echo $topnumber ?>. <?php echo $row["jobindustry"]; ?> (<?php echo $row["maxnumber"]; ?>)</span>
                        </label>
                    </p>
                <?php
                    $topnumber++;
                }
                ?>
            </form>
            <div class="is-divider"></div>
            <p class="subtitle is-size-5">Available Profession Slot</p>
            <form action="#" class="center-align" style="margin-bottom:10px ;">
                <?php

                $sql =(
                    "SELECT 
                    COUNT(jobid) 
                    as 
                    maxnumber
                    from 
                    tbl_job");

                $set = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($set)) {
                ?>
                    <p>
                        <label>

                            <p>Available Job (<?php echo $row["maxnumber"]; ?>) </p>
                        </label>
                    </p>

                <?php
                }
                ?>
            </form>
            <button onclick="resetList();" class="button is-light">Clear</button>
        </div>
    </div>
</div>