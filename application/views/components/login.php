<div class="container">
    <div class="row login-row form-gradient">
        <!-- Padding -->
        <div class="col-md-3"></div>

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
                        <label for="username">ID Number</label>
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
                                <button type="submit" class="btn btn-grey btn-rounded z-depth-1a">Log in</button>
                            </div>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-md-7">
                            <p class="font-small grey-text d-flex justify-content-end mt-3">Don't have an account? <a href="<?php echo base_url(); ?>signup" class="dark-grey-text ml-1 font-bold"> Sign up</a></p>
                        </div>
                        <!--Grid column-->
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>