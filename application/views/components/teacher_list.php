<div class="container">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($list) && $list): ?>
                            <?php foreach($list as $teacher): ?>
                                <tr>
                                    <td>
                                        <?=$teacher['lname']?>, <?=$teacher['fname']?>
                                    </td>
                                    <td>
                                        <?=$teacher['id_number']?>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger">
                                            DELETE
                                        </button>
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