<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto col-sm-12">
            <h4 class="">Login</h4>
            <p class="">Please enter your credentials to sign in.</p>
            <form class="register-form outer-top-xs" action="<?php echo site_url('account/authenticate'); ?>" method="post" role="form">
                <div class="form-group mt-3">
                    <label class="info-title" for="email">Email <span>*</span></label>
                    <input type="email" placeholder="Enter email" class="form-control unicase-form-control" id="email" name="email" value="<?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : set_value('email'); ?>">
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>
                <div class="form-group mt-3">
                    <label class="info-title" for="password">Password <span>*</span></label>
                    <input type="password" placeholder="Enter your password" class="form-control unicase-form-control text-input" id="password" name="password" value="<?php echo set_value('password'); ?>">
                    <span class="text-danger"><?php echo form_error('password'); ?></span>

                    <button type="submit" class="btn btn-primary mt-3">Login</button>
                </div>
                <a href="<?php echo site_url('account/recover'); ?>" class="forgot-password" style="color: white;">Forgot your Password?</a><br />
            </form>
            <br />
            <p>Don't have an account? <a class="primary-link" href="<?php echo site_url('account/register'); ?>" class="">Register here</a></p>
        </div>
    </div>
</div>