<div class="row">
    <div class="col-md-4 col-sm-12 mx-auto">
        <h4 class="checkout-subtitle">Register</h4>
        <p class="text title-tag-line">Enter your details and hit on Register Button to create a new account.</p>
        <form class="form-inline" action="<?php echo site_url('account/registerer'); ?>" method="post" role="form">
            <div class="form-group mt-3">
                <label class="info-title" for="name">Name <span>*</span></label>
                <input type="name" class="form-control unicase-form-control text-input" id="name" name="name" value="<?php echo set_value('name'); ?>">
                <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div>
            <div class="form-group mt-3">
                <label class="info-title" for="phone">Phone Number <span>*</span></label>
                <input type="text" pattern="[6789][0-9]{9}" maxlength="10" class="form-control unicase-form-control text-input" id="phone" name="phone" value="<?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : set_value('phone'); ?>">
                <span class="text-danger"><?php echo form_error('phone'); ?></span>
            </div>
            <div class="form-group mt-3">
                <label class="info-title" for="email">Email <span>*</span></label>
                <input type="email" class="form-control unicase-form-control text-input" id="email" name="email" value="<?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : set_value('email'); ?>" required>
                <span class="text-danger"><?php echo form_error('email'); ?></span>
            </div>
            <div class="form-group mt-3">
                <label class="info-title" for="password">Password <span>*</span></label>
                <input type="password" class="form-control unicase-form-control text-input" id="password" name="password" value="<?php echo set_value('password'); ?>">
                <span class="text-danger"><?php echo form_error('password'); ?></span>
            </div>
            <button type="submit" class="btn-upper btn btn-primary mt-3">Register</button>
        </form>
        <br />
        <p>Already have an account? <a class="primary-link" href="<?php echo site_url('account/login'); ?>" class="">Login here</a></p>
    </div>
</div>