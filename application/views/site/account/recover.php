<div class="row">
    <div class="col-md-4 col-sm-12 mx-auto">
        <h2 class="heading-title">Reset your password</h2>
        <span class="title-tag inner-top-ss">You can change your password by verifying your email</span>
        <form class="register-form outer-top-xs" action="<?php echo site_url('account/otp'); ?>" method="post" role="form">
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
    </div>