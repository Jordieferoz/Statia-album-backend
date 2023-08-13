<div class="container">
    <div class="full-width-div">
        <div class="row fill">
            <div class="col-lg-6 col-sm-12 d-none d-lg-flex d-flex justify-content-start login-left-image ">
                <img src="<?= base_url('/assets/site/images/hero-title.svg') ?>" draggable="false" alt="img" class="h-50 mt-5" />
                <p class="footer_text text-muted p-5"> &copy; 2023 Statia Tourism. All Rights Reserved.</p>
            </div>
            <div class="col-lg-6 col-sm-12 login_part ">
                <div class="row d-flex justify-content-center" >
                <div class="form_box shadow-lg p-4">
                    <form class="register-form" action="<?php echo site_url('account/authenticate'); ?>" method="post" role="form">
                        <p class="hello_head mb-3">Hello!</p>
                        <p class="text-center hello_head_sm mb-2">Please enter your User ID</p>
                        <p class="text-center hello_head_md mb-3">Don't have an account? <br /> <a href="<?php echo site_url('account/register'); ?>" class="link-warning text-white underline">Register here</a></p>
                        <div class="form-outline mb-3">
                            <input type="text" maxlength="8" placeholder="Enter User ID" class="form-control unicase-form-control p-3" id="uid" name="uid" value="<?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : set_value('uid'); ?>">
                            <span class="text-danger"><?php echo form_error('uid'); ?></span>
                        </div>
                        <div class="pt-1 mb-4">
                            <button type="submit" class="btn btn-warning text-light btn-lg btn-block w-100">Access Gallery</button>
                        </div>
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