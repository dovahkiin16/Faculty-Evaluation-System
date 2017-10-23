<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <?php if(isset($result) && $result): ?>
            <div class="alert alert-success mt-3 col-8">
                <strong>Success!</strong> <?=$result?>
            </div>
        <?php endif; ?>
        <?php if(isset($sched_err)): ?>
            <div class="alert alert-danger mt-3 col-8">
                <strong>Error!</strong> <?=$sched_err?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row login-row form-gradient">
        <div class="col-2"></div>
        <!-- Login component -->
        <div class="col-8 card p-md-0">
            <div class="header pt-3">

                <div class="row d-flex justify-content-center">
                    <h3 class="black-text mb-3 pt-3 font-bold">Schedule</h3>
                </div>
            </div>
            <div class="card-body mx-4 mt-4">
                <form method="post" action="<?php base_url()?>insert_schedule">
                    <h4 class="grey-text">Time</h4>
                    <div class="mb-2 form-inline row">
                        <select class="mdb-select col-3" name="day" required>
                            <option value="" disabled <?php echo isset($form['day'])? "" : "selected" ?>>Day</option>
                            <?php for($i = 1; $i <= 31; $i++): ?>
                                <option value="<?=$i?>" <?php echo isset($form['day']) && $form['day'] == $i? "selected" : ""?>><?=$i?></option>
                            <?php endfor; ?>
                        </select>
                        <select class="ml-2 mdb-select col-3" name="month" required>
                            <option value="" disabled <?php echo isset($form['month'])? "" : "selected" ?>>Month</option>
                            <option value="1" <?php echo isset($form['month']) && $form['month'] == 1? "selected" : ""?> >January</option>
                            <option value="2" <?php echo isset($form['month']) && $form['month'] == 2? "selected" : ""?>>February</option>
                            <option value="3" <?php echo isset($form['month']) && $form['month'] == 3? "selected" : ""?>>March</option>
                            <option value="4" <?php echo isset($form['month']) && $form['month'] == 4? "selected" : ""?>>April</option>
                            <option value="5" <?php echo isset($form['month']) && $form['month'] == 5? "selected" : ""?>>May</option>
                            <option value="6" <?php echo isset($form['month']) && $form['month'] == 6? "selected" : ""?>>June</option>
                            <option value="7" <?php echo isset($form['month']) && $form['month'] == 7? "selected" : ""?>>July</option>
                            <option value="8" <?php echo isset($form['month']) && $form['month'] == 8? "selected" : ""?>>August</option>
                            <option value="9" <?php echo isset($form['month']) && $form['month'] == 9? "selected" : ""?>>September</option>
                            <option value="10" <?php echo isset($form['month']) && $form['month'] == 10? "selected" : ""?>>October</option>
                            <option value="11" <?php echo isset($form['month']) && $form['month'] == 11? "selected" : ""?>>November</option>
                            <option value="12" <?php echo isset($form['month']) && $form['month'] == 12? "selected" : ""?>>December</option>
                        </select>
                        <select class="ml-2 mdb-select col-2" name="year" required>
                            <option value="" disabled <?php echo isset($form['year'])? "" : "selected" ?>>Year</option>
                            <?php for($i = date("Y"); $i<=(date("Y")+2); $i++): ?>
                                <option value="<?=$i?>" <?php echo isset($form['year']) && $form['year'] == $i? "selected" : ""?> ><?=$i?></option>
                            <?php endfor; ?>
                        </select>
                        <div class="col-1"></div>
                        <div class="md-form col-3 row">
                            <input placeholder="Selected time" type="text"
                                   id="input_starttime" name="time"
                                   <?php echo isset($form['time']) ? "value=\"".$form['time']."\"" : ""?>
                                   class="form-control timepicker col-12 my-auto"
                                   required>
                        </div>
                    </div>
                    <h4 class="grey-text">Room</h4>
                    <div class="mb-2 form-inline">
                        <select class="mdb-select" name="room">
                            <option value="" disabled <?php echo isset($form['room'])? "" : "selected" ?>>Room</option>
                            <option value="1" <?php echo isset($form['room']) && $form['room'] == 1? "selected" : ""?>>Room 1</option>
                            <option value="2" <?php echo isset($form['room']) && $form['room'] == 2? "selected" : ""?>>Room 2</option>
                        </select>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <h4 class="grey-text">Evaluator</h4>
                            <?php if(isset($evaluators) && $evaluators): ?>
                                <?php foreach($evaluators as $evaluator): ?>
                                    <div class="checkbox form-group bg-even px-2 pt-2">
                                        <input id="check<?=$evaluator->id?>" type="checkbox" class="filled-in" name="evaluator[]" value="<?=$evaluator->id?>"/>
                                        <label for="check<?=$evaluator->id?>">
                                            <?=$evaluator->level?>-<?=$evaluator->name ?>
                                        </label>
                                    </div>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-6">
                            <h4 class="grey-text">Evaluatee</h4>
                            <?php if(isset($evaluatees) && $evaluatees): ?>
                                <?php foreach($evaluatees as $evaluatee): ?>
                                    <div class="checkbox form-group bg-odd px-2 pt-2">
                                        <input id="check<?=$evaluatee->id?>" type="checkbox" name="evaluatee[]" class="filled-in" value="<?=$evaluatee->id?>"/>
                                        <label for="check<?=$evaluatee->id?>">
                                            <?=$evaluatee->lname?>, <?=$evaluatee->fname ?>
                                        </label>
                                    </div>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="row mx-0 d-flex justify-content-start">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
