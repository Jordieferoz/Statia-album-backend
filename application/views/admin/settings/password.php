<div class="card-body login-card-body">

        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
            <form action="<?php echo site_url('admin/settings/changePassword'); ?>" method="post">
                <div class="input-group mb-3">
                <input type="password" required name = "password" class="form-control" value = "<?php echo set_value('password'); ?>" placeholder="Current Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="feather-icon"><i data-feather="lock"></i></span>
                        </div>
                    </div>
                </div>
                    <span style = "color: red;"><?php echo form_error('password'); ?></span><br />
                <div class="input-group mb-3">
                    <input type="password" required name = "new_password" class="form-control" value = "<?php echo set_value('new_password'); ?>" placeholder="New Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="feather-icon"><i data-feather="unlock"></i></span>
                        </div>
                    </div>
                </div>
                    <span style = "color: red;"><?php echo form_error('new_password'); ?></span><br />
                    <button type="submit" name = "change" class="btn btn-primary btn-block">Change password</button>
                <!-- /.col -->
                </div>
            </div>
        </div>
        </form>
    </div>