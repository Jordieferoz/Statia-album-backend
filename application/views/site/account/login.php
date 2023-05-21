<div class="container">
    <div class="full-width-div">
        <div class="row fill">
            <div class="col-md-6 col-sm-12 d-none d-md-flex d-flex justify-content-start login-left-image ">
                <img src="<?= base_url('/assets/site/images/hero-title.svg') ?>" draggable="false" alt="img" class="h-50 mt-5" />
                <p class="footer_text text-muted p-5"> &copy; 2023 Statia-tourism. All Right Reserved.</p>
            </div>
            <div class="col-md-6 col-sm-12 login_part ">
                <div class="row  d-flex justify-content-center" >
                <div class="form_box shadow-lg p-4">
                    <form class="register-form" action="<?php echo site_url('account/authenticate'); ?>" method="post" role="form">
                        <p class="hello_head mb-3">Hello!</p>
                        <p class="text-center hello_head_sm mb-2">Please enter your credentials</p>
                        <p class="text-center hello_head_md mb-3">Don't have an account? <a href="<?php echo site_url('account/register'); ?>" class="link-warning underline">Register here</a></p>
                        <div class="form-outline mb-3">
                            <input type="email" placeholder="Enter email" class="form-control unicase-form-control p-3" id="email" name="email" value="<?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : set_value('email'); ?>">
                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="password" placeholder="Enter your password" class="form-control unicase-form-control text-input p-3" id="password" name="password" value="<?php echo set_value('password'); ?>">
                            <span class="text-danger"><?php echo form_error('password'); ?></span>
                        </div>
                        <div class="pt-1 mb-4">
                            <button type="submit" class="btn btn-warning text-light btn-lg btn-block w-100">Login</button>
                        </div>
                        <p class="text-center">
                            <a href="<?php echo site_url('account/recover'); ?>" class="underline text-secondary">Forgot your Password?</a>
                        </p>
                    </form>
                </div>
            </div>
            <div class="row d-flex justify-content-center" style="margin-bottom:20px;">
                <div class="errox_msg_box">
                    <?php $this->load->view('site/layouts/error_messages') ?>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>