<div class="container">
    <div class="row login-row form-gradient">
        <!-- Padding -->
        <div class="col-md-3">
            <h3 class="text-center">Vision</h3>
            <p class="text-justify">
                We dream of Filipino who passionately love their country and whose competencies and values enable them
                to realize their full potential and contribute meaningfully to building the nation.
            </p>
            <p class="text-justify">
                As learner-centered public institution, Tibag High School continuously improve itself to better serve
                its stakeholders.
            </p>
        </div>
        <!-- Login component -->
        <div class="col-md-6 card p-md-0">
            <div class="header pt-3 peach-gradient">

                <div class="row d-flex justify-content-center">
                    <h3 class="white-text mb-3 pt-3 font-bold">Log in</h3>
                </div>
            </div>
            <div class="card-body mx-4 mt-4">
                <form action="<?php base_url(); ?>signin" method="post">
                    <?php if(isset($err)): ?>
                        <div class="alert alert-danger mb-4">
                            <strong>Error!</strong> <?=$err?>
                        </div>
                    <?php endif; ?>
                    <div class="md-form">
                        <i class="fa fa-envelope prefix grey-text"></i>
                        <input type="number" id="username" name="username" class="form-control" required />
                        <label for="username">LRN/Employee number</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="password" name="pass" class="form-control" required />
                        <label for="password">Password</label>
                    </div>
                    <div class="row d-flex align-items-center mb-4">

                        <!--Grid column-->
                        <div class="col-md-1 col-md-5 d-flex align-items-start">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-rounded z-depth-1a">Log in</button>
                            </div>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-md-7">
                            <p class="font-small grey-text d-flex justify-content-end mt-3">Don't have an account?
                                <a href="<?php echo base_url(); ?>signup" class="dark-grey-text ml-1 font-bold"> Sign up</a>
                            </p>
                        </div>
                        <!--Grid column-->
                    </div>
                </form>

            </div>
        </div>
        <div class="col-md-3">
            <h3 class="text-center">Mission</h3>
            <p class="text-justify">
                To protect and promote the right of every Filipino to quality, equitable, culture-based, and complete
                basic education where:
            </p>
            <ul>
                <li class="text-justify"><i class="fa fa-arrow-right"></i> Pupils learn in a child-friendly, gender-sensitive, safe, and motivating environment.</li>
                <li class="text-justify"><i class="fa fa-arrow-right"></i> Teacher facilitate learning and constantly nurture every learner.</li>
                <li class="text-justify"><i class="fa fa-arrow-right"></i>
                    Administrators and staff, as stewards of the institution, ensure an enabling and supportive
                    environment for effective learning to happen.
                </li>
                <li class="text-justify"><i class="fa fa-arrow-right"></i>
                    Family, community, and other stakeholders are actively engaged and share responsibility
                    for developing life-long learners.
                </li>
            </ul>
        </div>
    </div>
</div>