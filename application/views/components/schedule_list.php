<div class="container">
    <div class="row my-4">
        <div class="col-2"></div>
        <!-- Login component -->
        <div class="col-8 card p-md-0">
            <div class="header pt-3">

                <div class="row d-flex justify-content-center">
                    <h3 class="black-text mb-3 pt-3 font-bold">Schedule list</h3>
                </div>
            </div>
            <div class="card-body">
                <?php if(isset($sched_list) && $sched_list): ?>
                    <?php foreach($sched_list as $sec=>$sched): ?>
                        <div class="mb-4">
                            <h4><?=$sec?></h4>
                            <p>
                                <b>Room No:</b><span><?=$sched['exam_room_no']?></span>
                            </p>
                            <p>
                                <b>Schedule: </b><span><?php echo date("F jS, Y", strtotime($sched['start_time'])); ?></span>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
