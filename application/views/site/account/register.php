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

                    <form class="form-inline" action="<?php echo site_url('account/registerer'); ?>" method="post" role="form">
                        <p class="hello_head mb-3">Register!</p>
                        <p class="text-center hello_head_sm mb-2">Enter details to create account</p>
                        <div class="form-outline mb-3">
                            <!-- <label class="info-title" for="name">Name <span>*</span></label> -->
                            <input type="name" class="form-control unicase-form-control p-3 text-input" id="name" name="name" value="<?php echo set_value('name'); ?>" placeholder="Your Name">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>

                        <div class="form-outline mt-3">
                            <!-- <label class="info-title" for="email">Email <span>*</span></label> -->
                            <input type="email" class="form-control unicase-form-control p-3 text-input" id="email" name="email" value="<?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : set_value('email'); ?>" required placeholder="Your Email">
                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                        </div>
                        <div class="form-outline mt-3">
                            <!-- <label class="info-title" for="phone">Phone Number <span>*</span></label> -->
                            <input type="text" pattern="[6789][0-9]{9}" maxlength="10" class="form-control unicase-form-control p-3 text-input" id="phone" name="phone" value="<?php echo ($this->uri->segment(3)) ? $this->uri->segment(3) : set_value('phone'); ?>" placeholder="Your Phone Number (Optional)">
                            <span class="text-danger"><?php echo form_error('phone'); ?></span>
                        </div>
                        <div class="form-outline mt-3">
                            <!-- <label class="info-title" for="password">Password <span>*</span></label> -->
                            <input type="password" class="form-control unicase-form-control p-3 text-input" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Create Password">
                            <span class="text-danger"><?php echo form_error('password'); ?></span>
                        </div>
                        <div class="pt-1 mb-4">
                            <button type="submit" class="btn-upper btn btn-warning text-light btn-lg btn-block w-100 mt-3">Register</button>
                        </div>
                        <!-- <button type="submit" class="btn-upper btn btn-warning mt-3">Register</button> -->
                        <p class="text-center">Already have an account?<br /><a href="<?php echo site_url('account/login'); ?>" class="link-warning underline">Login?</a>
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