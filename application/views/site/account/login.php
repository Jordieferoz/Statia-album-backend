<div class="container">
    <div class="row">
        <div class="col-md-6">
            <p class="sm_text">Welcome to</p>
            <div class="main_text_div">
                <p class="main_text1">Statia
                    <span class="main_text2">Tourism</span>
                </p>
                
            </div>
            <p class="sub_main_text">Photo and Video Gallery</p>
            <p class="footer_text text-muted"> &copy; 2023 Statia-tourism. All Right Reserved.</p>
        </div>
        <div class="col-md-6 login_part">
            <div class="form_box d-flex  mt-5 px-5 ms-xl-4  pt-5 pt-xl-0 mt-xl-n5" style="margin-top:30px; margin-bottom:30px">
                <form class="register-form" action="<?php echo site_url('account/authenticate'); ?>" method="post" role="form" style="width: 23rem; ">
                    <p class=" hello_head">Hello!</p>
                    <p class="text-center hello_head_sm ">Please enter your credentials</p>
                    <p class="text-center hello_head_md">Don't have an account? <a href="<?php echo site_url('account/register'); ?>" class="link-warning">Register here</a></p>
                    <div class="form-outline mb-4">
                        <input type="email" placeholder="Enter email" class="form-control unicase-form-control" id="email" name="email" value="<?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : set_value('email'); ?>">
                        <span class="text-danger"><?php echo form_error('email'); ?></span>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" placeholder="Enter your password" class="form-control unicase-form-control text-input" id="password" name="password" value="<?php echo set_value('password'); ?>">
                        <span class="text-danger"><?php echo form_error('password'); ?></span>
                    </div>
                    <div class="form-outline mb-4 text-start">
                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                        <label class="form-check-label" for="form1Example3"> Remember me </label>
                    </div>
                    <div class="pt-1 mb-4">
                        <button type="submit" class="btn btn-warning text-light btn-lg btn-block w-100">Login</button>
                    </div>
                    <p class="  text-center">
                        <a href="<?php echo site_url('account/recover'); ?>" class="text-muted">Forgot your Password?</a>
                    </p>
                </form>

            </div>
        </div>
    </div>