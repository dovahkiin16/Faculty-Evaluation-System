<div class="container">
    <?php if(isset($status) && $status != 'Password has been updated!'): ?>
        <div class="alert alert-danger mt-3">
            <strong>Error!</strong> <?=$status?>
        </div>
    <?php elseif (isset($status)): ?>
        <div class="alert alert-success mt-3">
            <strong>Success!</strong> <?=$status?>
        </div>
    <?php endif; ?>
    <div class="row my-4">
        <div class="col-2"></div>
        <!-- Login component -->
        <div class="col-8 card p-md-0">
            <div class="header pt-3">
                <div class="row d-flex justify-content-center">
                    <h3 class="black-text mb-3 pt-3 font-bold">Change Password</h3>
                </div>
            </div>
            <div class="card-body">
                <!-- TODO: Do stuffs here -->
                <form action="<?php echo base_url("user/changePass");?>" method="post">
                    <div class="md-form">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="pwd" name="pwd" class="form-control" required />
                        <label for="pwd">Password</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="cpwd" name="cpwd" class="form-control" required />
                        <label for="cpwd">Confirm Password</label>
                    </div>
                    <button class="btn btn-success" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
