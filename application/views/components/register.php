<div class="container">
    <?php if(isset($err)): ?>
    <div class="alert alert-danger mt-5">
        <strong>Error!</strong> <?=$err?>
    </div>
    <?php endif; ?>
    <section class="form-light mt-5 mb-1">
        <!--Form without header-->
        <div class="card">
            <div class="card-body mx-4">
                <form action="<?php echo base_url()?>register" method="post">
                    <!--Header-->
                    <div class="text-center">
                        <h3 class="pink-text mb-5"><strong>Sign up</strong></h3>
                    </div>

                    <div>
                        <label>Account type</label>
                        <select class="mdb-select" name="user_type" required>
                            <option value="" disabled selected>Account Type</option>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <div>
                        <label>Section</label>
                        <select class="mdb-select" name="section" required>
                            <option value="" disabled selected>Section</option>
                            <?php if(isset($sections) && $sections): ?>
                                <?php foreach($sections as $section): ?>
                                    <option value="<?=$section->id?>"><?=$section->level?>-<?=$section->name?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="md-form">
                        <input type="text" id="fname" name="fname" class="form-control" required>
                        <label for="fname">First Name</label>
                    </div>
                    <div class="md-form">
                        <input type="text" id="lname" name="lname" class="form-control" required>
                        <label for="lname">Last Name</label>
                    </div>
                    <!--Body-->
                    <div class="md-form">
                        <input type="text" id="username" name="username" class="form-control" required>
                        <label for="username">Username</label>
                    </div>

                    <div class="md-form pb-3">
                        <input type="password" id="pwd" name="password" class="form-control" required>
                        <label for="pwd">Password</label>
                    </div>

                    <!--Grid row-->
                    <div class="row d-flex align-items-center mb-4">

                        <div class="col-md-3 col-md-6 text-center">
                            <button type="submit" class="btn btn-pink btn-block btn-rounded z-depth-1">Sign up</button>
                        </div>
                        <div class="col-md-6">
                            <p class="font-small grey-text d-flex justify-content-end">Have an account? <a href="<?php echo base_url(); ?>" class="blue-text ml-1"> Log in</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>