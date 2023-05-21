<div class="container">
    <div class="full-width-div">
        <div class="row fill">
            <div class="col-md-6 col-sm-12 d-none d-md-flex d-flex justify-content-start login-left-image">
                <img src="<?= base_url('/assets/site/images/hero-title.svg') ?>" draggable="false" alt="img" class="h-50 mt-5" />
                <p class="footer_text text-muted p-5"> &copy; 2023 Statia-tourism. All Right Reserved.</p>
            </div>
            <div class="col-md-6 col-sm-12 login_part ">
                <div class="row  d-flex justify-content-center" >
                <div class="form_box shadow-lg p-4">
                    <form class="register-form" action="<?php echo site_url('account/changer/' . $this->uri->segment(3)); ?>" method="post" role="form">
                        <p class="hello_head mb-3">Reset</p>
                        <p class="text-center hello_head_sm mb-2">Please enter a secure password.</p>
                        <div class="form-group mt-3">
                            <label class="info-title" for="otp">New Password</label>
                            <input type="text" required placeholder="Enter your new password" class="form-control unicase-form-control text-input p-3" id="password" name="password">
                        </div>
                        <div class="pt-1 mb-4 mt-2">
                            <button type="submit" name="changer" class="btn btn-warning text-light btn-lg btn-block w-100">Change Password</button>
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