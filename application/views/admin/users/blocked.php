<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">BLOCKED USERS</h5>
    <div class="row">
        <div class="col-sm">
            <div class="table-responsive">
                <table id="datable_1" class="table table-hover w-200">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Joined date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($BLOCKED_USERS as $user) {
                        ?>
                            <tr>
                                <td><?php echo $user->id; ?></td>
                                <td><?php echo $user->name; ?></td>
                                <td><?php echo $user->phone; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->joined_date . ' - ' . $user->joined_time; ?></td>
                                <td><span class="badge badge-pill badge-<?php echo ($user->is_verified == 1) ? 'success' : 'danger'; ?>"><?php echo ($user->is_verified == 1) ? 'Verified' : 'Not verified'; ?></span></td>
                                <td>

                                    <?php if ($user->is_active == 1) { ?>
                                        <a href="<?php echo site_url('admin/users/changeStatus/users/0/' . $user->id); ?>" class="btn btn-danger btn-xs">Block</a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url('admin/users/changeStatus/users/1/' . $user->id); ?>" class="btn btn-success btn-xs">Active</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>