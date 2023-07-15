<!-- <div class="row">
    <div class="col-md-4 col-sm-12 mx-auto">
        <form class="register-form outer-top-xs" action="" method="post" role="form">
            <div class="form-group">
                <label class="info-title" for="otp">Email</label>
                <input type="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : set_value('email'); ?>" <?php echo (isset($_GET['email'])) ? 'readonly' : ''; ?> required placeholder="Enter your registered Email" class="form-control unicase-form-control text-input" id="email" name="email">
            </div>
            <?php if (!isset($_GET['email'])) { ?>
                <button type="submit" name="send" class="btn-upper btn btn-primary mt-3">Send OTP</button>
            <?php } ?>
        </form>
        <?php if (isset($_GET['email'])) { ?>
            <form class="register-form outer-top-xs" autocomplete="off" action="<?php echo site_url('account/tryrecover'); ?>" method="post" role="form">
                <div class="form-group">
                    <input type="hidden" value="<?php echo isset($_GET['email']) ? $_GET['email'] : set_value('email'); ?>" required name="email">
                    <label class="info-title" for="otp">OTP</label>
                    <input type="text" pattern="[0-9]{6}" maxlength="6" <?php echo (isset($_GET['email'])) ? 'required' : ''; ?> placeholder="Enter your OTP here" class="form-control unicase-form-control text-input" id="otp" name="otp">
                </div>
                <button type="submit" class="btn-upper btn btn-primary mt-3">Verify</button>
            </form>
        <?php } ?>
    </div> -->

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
                        <form class="register-form" action="<?php echo site_url('account/otp'); ?>" method="post" role="form">
                            <p class="hello_head mb-3">Recover</p>
                            <p class="text-center hello_head_sm mb-2">You can change your password by verifying your email</p>
                            <div class="form-group">
                                <label class="info-title" for="otp">Email</label>
                                <input type="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : set_value('email'); ?>" <?php echo (isset($_GET['email'])) ? 'readonly' : ''; ?> required placeholder="Enter your registered Email" class="form-control unicase-form-control text-input p-3" id="email" name="email">
                            </div>
                            <?php if (!isset($_GET['email'])) { ?>
                                <div class="pt-1 mb-4 mt-2">
                                    <button type="submit" name="send" class="btn btn-warning text-light btn-lg btn-block w-100">Send OTP</button>
                                </div>
                            <?php } ?>
                        </form>
                            <?php if (isset($_GET['email'])) { ?>
                                <form class="register-form outer-top-xs" autocomplete="off" action="<?php echo site_url('account/tryrecover'); ?>" method="post" role="form">
                                    <div class="form-group">
                                        <input type="hidden" value="<?php echo isset($_GET['email']) ? $_GET['email'] : set_value('email'); ?>" required name="email">
                                        <label class="info-title" for="otp">OTP</label>
                                        <input type="text" pattern="[0-9]{6}" maxlength="6" <?php echo (isset($_GET['email'])) ? 'required' : ''; ?> placeholder="Enter your OTP here" class="form-control unicase-form-control text-input p-3" id="otp" name="otp">
                                    </div>
                                    <button type="submit" class="btn btn-warning text-light btn-lg btn-block w-100 mt-3">Verify</button>
                                </form>
                            <?php } ?>
                            
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