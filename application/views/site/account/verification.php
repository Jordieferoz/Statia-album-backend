<div class="row">
    <!-- Sign-in -->
    <div class="col-md-4 col-sm-12 mx-auto">
        <h2 class="heading-title">Verify your email</h2>
        <span class="title-tag inner-top-ss">We have sent an OTP (One Time Password) to your email.</span>
        <form class="register-form outer-top-xs" action="<?php echo site_url('account/verify/' . $this->uri->segment(3)); ?>" method="post" role="form">
            <div class="form-group">
                <label class="info-title" for="otp">OTP *</label>
                <input type="text" pattern="[0-9]{6}" maxlength="6" required placeholder="Enter your OTP here" class="form-control unicase-form-control text-input" id="otp" name="otp">
            </div>
            <button type="submit" class="btn-upper btn btn-primary mt-3">Verify</button>
        </form>
    </div>
</div>