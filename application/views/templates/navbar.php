<nav class="navbar navbar-expand-lg navbar-dark indigo">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url('');?>"><img src="<?php echo base_url();?>img/ico.png" height="50" /> Tibag High School</a>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link waves-effect waves-light dropdown-toggle"
                                id="accounts-dropdown"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                Accounts
                            </a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="accounts-dropdown">
                                <a class="dropdown-item" href="<?=base_url();?>dashboard/teacher">Teacher</a>
                                <a class="dropdown-item" href="<?=base_url();?>dashboard/student">Student</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link waves-effect waves-light dropdown-toggle"
                               id="sched-dropdown"
                               data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false">
                                Schedules
                            </a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="sched-dropdown">
                                <a class="dropdown-item" href="<?=base_url("schedule/add");?>">Create Schedule</a>
                                <a class="dropdown-item" href="<?=base_url("schedule/view");?>">View Schedules</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link waves-effect waves-light dropdown-toggle"
                               id="sec-dropdown"
                               data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false">
                                Sections
                            </a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="sec-dropdown">
                                <a class="dropdown-item" href="<?=base_url('section/add');?>">Create Section</a>
                                <a class="dropdown-item" href="<?=base_url('section/view');?>">View Sections</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="<?=base_url("print")?>">
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
                        <a class="nav-link waves-effect waves-light" href="<?=base_url('logout');?>">
                            <i class="fa fa-sign-out"></i>
                            Logout
                        </a>
                        </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>