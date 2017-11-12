<div class="container">
    <?php if(isset($ins_res) && $ins_res): ?>
        <div class="alert alert-success mt-3">
            <strong>Success!</strong> <?=$ins_res?>
        </div>
    <?php endif; ?>
    <?php if(!(isset($confirmed) && $confirmed)): ?>
        <div class="alert alert-warning mt-3">
            Account is not confirmed. Please ask the administrator for assistance.
        </div>
    <?php elseif(isset($err) && $err): ?>
        <div class="alert alert-warning mt-3">
            <?=$err?>
        </div>
    <?php else: ?>
        <div class="row my-4">
            <div class="col-12 card p-md-0">
                <div class="header pt-3">

                    <div class="row d-flex justify-content-center">
                        <h3 class="black-text pt-3 font-bold">Evaluation Form</h3>
                    </div>
                </div>
                <div class="card-body">
                    <h3>Currently Evaluating <b><u><i><?=$teacher->lname?>, <?=$teacher->fname?></i></u></b></h3>
                    <hr>
                    <div>
                        <form method="post" action="<?php echo base_url();?>submit_eval">
                            <h4>I. Explicit Curriculum</h4>
                            <input type="hidden" name="teacher" value="<?=$teacher->id?>"/>
                            <p class="grey-text">
                                How well does the teacher teach the core Subject?
                            </p>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <th>
                                        Question
                                    </th>
                                    <th>
                                        Outstanding
                                    </th>
                                    <th>
                                        Very Satisfactory
                                    </th>
                                    <th>
                                        Satisfactory
                                    </th>
                                    <th>
                                        Unsatisfactory
                                    </th>
                                    <th>
                                        Strongly Disagree
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                    </th>
                                    <th>
                                        (5)
                                    </th>
                                    <th>
                                        (4)
                                    </th>
                                    <th>
                                        (3)
                                    </th>
                                    <th>
                                        (2)
                                    </th>
                                    <th>
                                        (1)
                                    </th>
                                </tr>
                                <?php foreach($ec as $q): ?>
                                    <tr>
                                        <td>
                                            <?=$q->question?>
                                        </td>
                                        <td class="text-center">
                                            <input type="radio" name="q-<?=$q->id?>" id="q-<?=$q->id?>-5" value="5" required/>
                                            <label for="q-<?=$q->id?>-5"></label>
                                        </td>
                                        <td class="text-center">
                                            <input type="radio" name="q-<?=$q->id?>" id="q-<?=$q->id?>-4" value="4" />
                                            <label for="q-<?=$q->id?>-4"></label>
                                        </td>
                                        <td class="text-center">
                                            <input type="radio" name="q-<?=$q->id?>" id="q-<?=$q->id?>-3" value="3" />
                                            <label for="q-<?=$q->id?>-3"></label>
                                        </td>
                                        <td class="text-center">
                                            <input type="radio" name="q-<?=$q->id?>" id="q-<?=$q->id?>-2" value="2" />
                                            <label for="q-<?=$q->id?>-2"></label>
                                        </td>
                                        <td class="text-center">
                                            <input type="radio" name="q-<?=$q->id?>" id="q-<?=$q->id?>-1" value="1" />
                                            <label for="q-<?=$q->id?>-1"></label>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <hr />
                            <h4>II. Implicit Curriculum</h4>
                            <p class="grey-text">
                                How well does the teacher model the core values through how he/she behaves with students
                                and with other staff persons?
                            </p>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <th>
                                        Question
                                    </th>
                                    <th>
                                        Outstanding
                                    </th>
                                    <th>
                                        Very Satisfactory
                                    </th>
                                    <th>
                                        Satisfactory
                                    </th>
                                    <th>
                                        Unsatisfactory
                                    </th>
                                    <th>
                                        Strongly Disagree
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                    </th>
                                    <th>
                                        (5)
                                    </th>
                                    <th>
                                        (4)
                                    </th>
                                    <th>
                                        (3)
                                    </th>
                                    <th>
                                        (2)
                                    </th>
                                    <th>
                                        (1)
                                    </th>
                                </tr>
                                <?php foreach($ic as $q): ?>
                                    <tr id="<?=$q->id?>">
                                        <td>
                                            <?=$q->question?>
                                        </td>
                                        <td class="text-center">
                                            <input type="radio" name="q-<?=$q->id?>" id="q-<?=$q->id?>-5" value="5" required/>
                                            <label for="q-<?=$q->id?>-5"></label>
                                        </td>
                                        <td class="text-center">
                                            <input type="radio" name="q-<?=$q->id?>" id="q-<?=$q->id?>-4" value="4" />
                                            <label for="q-<?=$q->id?>-4"></label>
                                        </td>
                                        <td class="text-center">
                                            <input type="radio" name="q-<?=$q->id?>" id="q-<?=$q->id?>-3" value="3" />
                                            <label for="q-<?=$q->id?>-3"></label>
                                        </td>
                                        <td class="text-center">
                                            <input type="radio" name="q-<?=$q->id?>" id="q-<?=$q->id?>-2" value="2" />
                                            <label for="q-<?=$q->id?>-2"></label>
                                        </td>
                                        <td class="text-center">
                                            <input type="radio" name="q-<?=$q->id?>" id="q-<?=$q->id?>-1" value="1" />
                                            <label for="q-<?=$q->id?>-1"></label>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-md-3 col-md-6 text-center">
                                    <button type="submit" class="btn btn-pink btn-block btn-rounded z-depth-1">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>