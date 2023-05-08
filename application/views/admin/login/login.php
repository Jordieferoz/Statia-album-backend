<!-- HK Wrapper -->
<div class="hk-wrapper">

<!-- Main Content -->
<div class="hk-pg-wrapper hk-auth-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 pa-0">
                <div class="auth-form-wrap py-xl-0 py-50">
                    <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">
                        

					<?php
						if ($this->session->flashdata('message')) {
							echo '<div class = "alert alert-danger">' . $this->session->flashdata('message') .'</div>';
						}
					?>
                        <form method="post" action = "<?php echo site_url('admin/authentication/processLogin'); ?>">
                            <h1 class="display-4 mb-10">Welcome Back Admin :)</h1>
                            <p class="mb-30">Sign in to your account to start your session.</p>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder = "Enter your email" name = "email" value = "<?php echo set_value('email'); ?>">
							  <span class = "text-error"><?php echo form_error('email'); ?></span>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                <input type="password" name = "password" class="form-control" value = "<?php echo set_value('password'); ?>" placeholder="Enter your password">
                                <!-- <div class="input-group-append">
                                    <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
                                </div> -->
                            </div>
                            <span class = "text-error"><?php echo form_error('password'); ?></span>
                            </div>
                            <div class="custom-control custom-checkbox mb-25">
                                <input class="custom-control-input" id="same-address" type="checkbox" checked>
                                <label class="custom-control-label font-14" for="same-address">Keep me logged in</label>
                            </div>
                            <button class="btn btn-primary btn-block" name = "login" type="submit">Start session</button>
                            <!-- <p class="font-14 text-center mt-15">Having trouble logging in?</p> -->
                            <!-- <div class="option-sep">or</div>
                            <div class="form-row">
                                <div class="col-sm-6 mb-20">
                                    <button class="btn btn-indigo btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-facebook"></i> </span><span class="btn-text">Login with facebook</span></button>
                                </div>
                                <div class="col-sm-6 mb-20">
                                    <button class="btn btn-sky btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-twitter"></i> </span><span class="btn-text">Login with Twitter</span></button>
                                </div>
                            </div> -->
                            <!-- <p class="text-center">Do have an account yet? <a href="#">Sign Up</a></p> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Main Content -->

</div>
<!-- /HK Wrapper -->