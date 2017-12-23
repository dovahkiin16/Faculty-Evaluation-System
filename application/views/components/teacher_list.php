<div class="container">
    <?php if(isset($status) && $status == 'Password reset failed'): ?>
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
                    <h3 class="black-text mb-3 pt-3 font-bold">Teachers</h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Employee Number
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($list) && $list): ?>
                            <?php foreach($list as $teacher): ?>
                                <tr id="teacher-<?=$teacher['id']?>">
                                    <td>
                                        <?=$teacher['lname']?>, <?=$teacher['fname']?>
                                    </td>
                                    <td>
                                        <?=$teacher['id_number']?>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <a class="btn btn-success col-5"
                                               href="<?php echo base_url("result/teach_res/").$teacher['id'];?>">View Result</a>
                                            <a class="btn btn-danger col-5"
                                               href="<?php echo base_url("user/resetPwd/" . $teacher['id']);?>?src=teacher">
                                                Reset Password
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
