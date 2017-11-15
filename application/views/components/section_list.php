<div class="container">
    <div class="row my-4">
        <div class="col-2"></div>
        <!-- Login component -->
        <div class="col-8 card p-md-0">
            <div class="header pt-3">

                <div class="row d-flex justify-content-center">
                    <h3 class="black-text mb-3 pt-3 font-bold">Section Students</h3>
                </div>
            </div>
            <div class="card-body">
                <?php if(isset($sections) && $sections): ?>
                    <div class="row">
                        <?php foreach($sections as $section): ?>
                            <div class="mb-4 col-6">
                                <h4>Grade <?=$section['level']?>-<?=$section['name']?></h4>
                                <?php if(count($section['students']) > 0): ?>
                                    <button class="btn btn-success sec-list-expander" value="<?=$section['id']?>">Load More</button>
                                    <div id="expand-<?=$section['id']?>" style="display: none;">
                                        <?php foreach($section['students'] as $student): ?>
                                            <div class="bg-even p-2">
                                                <?=$student->lname?>, <?=$student->fname?>
                                            </div>
                                        <?php endforeach;?>
                                    </div>
                                <?php else: ?>
                                    <p>
                                        This Section has no Students Registered
                                    </p>
                                <?php endif;?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
