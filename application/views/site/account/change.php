<div class="row">
    <div class="col-md-4 col-sm-12 mx-auto">
        <h2 class="heading-title">Change Password</h2>
        <form class="register-form outer-top-xs" autocomplete="off" action="<?php echo site_url('account/changer/' . $this->uri->segment(3)); ?>" method="post" role="form">
            <div class="form-group mt-3">
                <label class="info-title" for="otp">New Password</label>
                <input type="text" required placeholder="Enter your new password" class="form-control unicase-form-control text-input" id="password" name="password">
            </div>
            <button type="submit" name="changer" class="btn-upper btn btn-primary mt-3">Change Password</button>
        </form>
    </div>
</div>