<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">INACTIVE CATEGORIES</h5>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <table id="datable_1" class="table table-hover w-200">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($CATEGORIES as $category) {
                        ?>
                            <tr>
                                <td><?php echo $category->id; ?></td>
                                <td><?php echo $category->category; ?></td>
                                <td><?php echo $category->added_date . ' - ' . $category->added_time; ?></td>
                                <td><?php echo ($category->is_active == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>'; ?></td>
                                <td>
                                    <?php if ($category->is_active == 1) { ?>
                                        <a href="<?php echo site_url('admin/categorization/changeStatus/categories/0/' . $category->id); ?>" class="btn btn-danger btn-xs">Inactive</a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url('admin/categorization/changeStatus/categories/1/' . $category->id); ?>" class="btn btn-success btn-xs">Active</a>
                                    <?php } ?>
                                    <a href="<?php echo site_url('admin/categorization/changeStatus/categories/3/' . $category->id); ?>" class="btn btn-danger btn-xs">Delete</a>
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