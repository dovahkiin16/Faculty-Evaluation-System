<div class="container">
    <?php if(isset($result) && $result): ?>
        <div class="alert alert-success mt-5">
            <strong>Success!</strong> <?=$result?>
        </div>
    <?php endif; ?>
    <?php if(isset($err)): ?>
        <div class="alert alert-danger mt-5">
            <strong>Error!</strong> <?=$err?>
        </div>
    <?php endif; ?>
    <div class="row login-row">
        <div class="col-2"></div>
        <!-- Login component -->
        <div class="col-8 card p-md-0">
            <div class="header pt-3">

                <div class="row d-flex justify-content-center">
                    <h3 class="black-text mb-3 pt-3 font-bold">Add new section</h3>
                </div>
            </div>
            <div class="card-body mx-4 mt-2">
                <form method="post" action="<?php echo base_url('add_section');?>">
                    <div class="md-form">
                        <input type="number" id="level" name="level" class="form-control" min="7" max="12" required>
                        <label for="level">Grade Level</label>
                    </div>
                    <div class="md-form">
                        <input type="text" id="name" name="name" class="form-control" required>
                        <label for="name">Section Name</label>
                    </div>

                    <div>
                        <h4 class="grey-text">Teachers</h4>
                        <?php if(isset($evaluatees) && $evaluatees): ?>
                            <?php foreach($evaluatees as $evaluatee): ?>
                                <div class="checkbox form-group bg-odd px-2 pt-2">
                                    <input id="checkev<?=$evaluatee->id?>" type="checkbox" name="evaluatee[]" class="filled-in" value="<?=$evaluatee->id?>"/>
                                    <label for="checkev<?=$evaluatee->id?>">
                                        <?=$evaluatee->lname?>, <?=$evaluatee->fname ?>
                                    </label>
                                </div>
                            <?php endforeach ?>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
