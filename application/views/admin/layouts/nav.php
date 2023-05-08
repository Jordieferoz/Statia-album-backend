
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="loader-pendulums"></div>
	</div>
	<!-- /Preloader -->

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand font-weight-700" href="<?php echo site_url('admin/dashboard'); ?>">
                <?php echo PROJECT_NAME; ?>
            </a>
            <ul class="navbar-nav hk-navbar-content">
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar mr-10">
                                    <span class="avatar-text avatar-group-sm avatar-text-danger rounded-circle"><span class="initial-wrap"><span><?php echo mb_substr(PROJECT_NAME, 0, 1); ?></span></span>
                                    </span>
                                </div>
                                <!-- <span class="badge badge-success badge-indicator"></span> -->
                            </div>
                            <div class="media-body">
                                <span><?php echo PROJECT_NAME; ?><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <a class="dropdown-item" href="<?php echo site_url('admin/settings/password'); ?>"><i class="dropdown-icon zmdi zmdi-lock"></i><span>Password</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo site_url('admin/dashboard/logout'); ?>"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                    </div>
                </li>
            </ul>
        </nav>
        <form role="search" class="navbar-search">
            <div class="position-relative">
                <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
                <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
            </div>
        </form>
        <!-- /Top Navbar -->