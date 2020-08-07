<div class="card is-shadowless">
    <div class="card-content">
        <p id="titles" class="title is-size-2">Applicant Information<p>
        <form id="fupForm" enctype="multipart/form-data">
            <input type="hidden" id="jobid" name="jobid" value="<?php echo $jobid ?>">
            <div class="field">
                <label for="first_name">First Name</label>
                <input placeholder="(Required)" id="firstname" name="firstname" type="text" class="validate input" required>
            </div>
            <div class="field">
                <label for="last_name">Last Name</label>
                <input placeholder="(Required)" id="lastname" name="lastname" type="text" class="validate input" required>
            </div>
            <div class="field">
                <label for="email" data-error="wrong" data-success="right">Email (Make sure email address valid unless email will not receive)</label>
                <input placeholder="(Required) " id="emailsub" name="emailsub" type="email" class="validate input" required>
            </div>
            <div class="field">
                <label for="name">Contact No.</label>
                <input placeholder="09xxxxxxxxx" class="validate input" type="tel" id="contact" name="contact" pattern="^(09|\+639)\d{9}$" required>
            </div>
            <div class="field">
                <label for="name">Address</label>
                <input placeholder="(Required)" class="validate input" type="text" id="address" name="address" required>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label for="name">Age</label>
                        <div class="control">
                            <div class="select">
                                <select id="age" name="age" class="browser-default " class="validate title" required>
                                    <option value="" selected>Choose Age</option>
                                    <?php for ($i = 18; $i < 40; $i++) {
                                    ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label for="name">Gender</label>
                        <div class="control">
                            <div class="select">
                                <select id="gender" name="gender" class="browser-default " class="validate" required>
                                    <option value="" disabled selected>Choose Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <label>
                Upload any Resume/Biodata/Curriculum Vitae image or word format or pdf format for validation and security purposes.
            </label>
            <div class="file mt-2">
                <label class="file-label">
                    <input id="file" name="file" type="file" required />
                </label>
            </div>
            <div class="field is-grouped is-grouped-right">
                <p class="control">
                    <input id="titles" class=" submitBtn button is-light mt-3" type="submit" id="submit" name="submit" value="Apply Now" />
                </p>
            </div>
        </form>
    </div>
</div>