<div class="row">
    <div class="col-xl-5 mx-auto pa-0" style="margin: 15%;">
        <div class="card py-xl-0">
            <div class="card-body">
                <?php
                if ($this->session->flashdata('message')) {
                    echo '<div class = "alert alert-danger">' . $this->session->flashdata('message') . '</div>';
                }
                ?>
                <form method="post" action="<?php echo site_url('admin/authentication/processLogin'); ?>">
                    <center>
                        <img src="<?= base_url('assets/site/images/logo.png') ?>" alt="logo" height="80" width="90" />
                        <h1 class="display-5" style="font-weight: 700;">Welcome Admin!</h1>
                        <p class="mb-30">Login to your account</p>
                    </center>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Enter your email" name="email" value="<?php echo set_value('email'); ?>">
                        <span class="text-error"><?php echo form_error('email'); ?></span>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>" placeholder="Enter your password">
                        </div>
                        <span class="text-error"><?php echo form_error('password'); ?></span>
                    </div>
                    <button class="btn btn-primary btn-block" name="login" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>