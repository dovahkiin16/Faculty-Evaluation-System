<div class="container">
    <?php if(isset($result) && $result): ?>
        <div class="alert alert-success mt-3">
            <strong>Success!</strong> <?=$result?>
        </div>
    <?php endif; ?>
    <?php if(isset($err)): ?>
        <div class="alert alert-danger mt-3">
            <strong>Error!</strong> <?=$err?>
        </div>
    <?php endif; ?>
    <form action="<?php echo base_url(); ?>user/confirm" method="post" class="form-simple mt-3 mb-1">
        <div class="card">

            <!--Header-->
            <div class="header pt-3 grey lighten-2">

                <div>
                    <div class="row">
                        <h3 class="deep-grey-text mt-3 mb-2 pb-1 mx-5">Confirm Student Accounts</h3>
                    </div>
                </div>

                <?php if(isset($users) && $users):  ?>
                    <div class="d-flex justify-content-start">
                        <div class="row mx-0 d-flex justify-content-start">
                            <button type="submit" class="btn btn-success" name="conf_all" value="conf">Confirm Selected</button>
                        </div>
                        <div class="row mx-0">
                            <button type="submit" class="btn btn-danger" name="del_all" value="del">Delete Selected</button>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
            <!--Header-->
            <div class="card-body p-0">
                <?php if(isset($users) && $users): ?>
                    <?php foreach ($users as $user):?>
                        <div class="checkbox row mx-0 bg-even">
                            <div class="form-group col-6 my-auto">
                                <input type="checkbox" name="userId[]" id="check<?=$user->id?>" class="filled-in ml-3" value="<?=$user->id?>">
                                <label for="check<?=$user->id?>">
                                    <?=$user->lname?>, <?=$user->fname?>
                                </label>
                            </div>
                            <div class="inline col-6 d-flex justify-content-end">
                                <button class="btn btn-success" name="conf" value="<?=$user->id?>"><i class="fa fa-check"></i></button>
                                <button class="btn btn-danger" name="del" value="<?=$user->id?>"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="checkbox row mx-0 bg-even">
                        <h4 class="mx-auto grey-text my-4">
                            No Accounts to be verified at the moment
                        </h4>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </form>
</div>