<div class="container">
    <div class="full-width-div">
        <div class="row fill">
            <div class="col-lg-6 col-sm-12 d-none d-lg-flex d-flex justify-content-start login-left-image ">
                <img src="<?= base_url('/assets/site/images/hero-title.svg') ?>" draggable="false" alt="img" class="h-50 mt-5" />
                <p class="footer_text text-muted p-5"> &copy; 2023 Statia-tourism. All Rights Reserved.</p>
            </div>
            <div class="col-lg-6 col-sm-12 login_part ">
                <div class="row  d-flex justify-content-center" >
                <div class="form_box shadow-lg p-4">
                    <form class="register-form" action="<?php echo site_url('account/verify/' . $this->uri->segment(3)); ?>" method="post" role="form">
                        <p class="hello_head mb-3">Verification</p>
                        <p class="text-center hello_head_sm mb-2">We have sent an OTP (One Time Password) to your email.</p>
                        <div class="form-group">
                            <label class="info-title" for="otp">OTP *</label>
                            <input type="text" pattern="[0-9]{6}" maxlength="6" required placeholder="Enter your OTP here" class="form-control unicase-form-control text-input p-3" id="otp" name="otp">
                        </div>
                        <div class="pt-1 mb-4">
                            <button type="submit" class="btn btn-warning text-light btn-lg btn-block w-100">Verify</button>
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