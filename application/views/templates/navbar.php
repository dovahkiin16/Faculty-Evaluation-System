<nav class="navbar navbar-expand-lg navbar-dark indigo">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>img/ico.png" height="50" /> Tibag High School</a>
        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <?php if(isset($_SESSION['userId'])): ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if($_SESSION['userType'] == 'admin'): ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="<?=base_url()?>dashboard">
                                Verify Accounts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="<?=base_url()?>schedule">
                                Schedules
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="<?=base_url()?>sections">
                                Sections
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="<?=base_url()?>print">
                                Results
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light">
                            <i class="fa fa-user-circle"></i>
                            <?=$_SESSION['name']?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light" href="<?php base_url();?>logout">
                            <i class="fa fa-sign-out"></i>
                            Logout
                        </a>
                        </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>