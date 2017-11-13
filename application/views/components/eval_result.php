<div class="container">
    <div class="row my-4">
        <div class="col-2"></div>
        <div class="col-8 card p-md-0">
            <div class="header pt-3">

                <div class="row d-flex justify-content-center">
                    <h3 class="black-text pt-3 font-bold">Evaluation Result</h3>
                </div>
            </div>
            <div style="display: none;">
                <?php for($i = 5; $i > 0; $i--):?>
                    <span id="__<?=$i?>">
                        <?php echo isset($scores[$i]) ? $scores[$i] : '0'  ?>
                    </span>
                <?php endfor;?>
            </div>
            <div class="card-body">
                <h4><?=$teacher->lname?>, <?=$teacher->fname?></h4>
                <?php if(isset($section) && $section !=null && !(is_array($section))):?>
                    <h4><?=$section->level?>-<?=$section->name?></h4>
                <?php endif;?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                Category
                            </th>
                            <th>
                                Score
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                            I. Explicit Curriculum
                            </th>
                            <td>
                                <?=isset($ec_sc) ? $ec_sc : 'None' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                II. Implicit Curriculum
                            </th>
                            <td>
                                <?=isset($ic_sc) ? $ic_sc : 'None' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Overall Descriptive Rating
                            </th>
                            <td>
                                <?=isset($desc_rating) ? $desc_rating : 'None' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Number of Evaluators
                            </th>
                            <td>
                                <?=isset($eval_count) ? $eval_count : 'None' ?>
                            </td>
                        </tr>
                        <?php foreach($quest_res as $key => $res):?>
                            <tr>
                                <th>
                                    <?=$key+1?>. <?=$res[0]?>
                                </th>
                                <td>
                                    <?=$res[1]?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <canvas id="myChart" width="600" height="400"></canvas>
                <script>
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["Outstanding", "Very Satisfactory", "Satisfactory", "Unsatisfactory", "Poor"],
                            datasets: [{
                                label: '# of Votes',
                                data: [ $('#__5').text(), $('#__4').text(), $('#__3').text(), $('#__2').text(), $('#__1').text()],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            },
                            responsive: false
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>