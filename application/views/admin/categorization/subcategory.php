<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">ADD NEW</h5>
    <p class="mb-40">Eg: Apple, Cabbage etc.</p>
    <div class="row">
        <div class="col-sm">
            <form method="post" autocomplete="off" action="<?php echo site_url('admin/categorization/newSubCategory'); ?>">
                <div class="row">

                    <div class="col-sm-4">

                        <select name="category" id="" class="form-control" required>
                            <option value="" disabled selected>--select category--</option>
                            <?php
                            foreach ($CATEGORIES as $category) { ?>
                                <option value="<?php echo $category->category; ?>"><?php echo $category->category; ?></option>
                            <?php }
                            ?>
                        </select>

                    </div><br />

                    <div class="col-sm-4">

                        <input type="text" name="subcategory" placeholder="Enter sub-category name here" id="" class="form-control" required>

                    </div><br />

                    <div class="col-sm-4">

                        <button type="submit" name="add" class="btn btn-info">ADD</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title"><?= $TITLE; ?></h5>
    <div class="row mt-4 mb-4">
        <div class="col-sm-4">
            <form action="" method="get">
                <label for="categiry">Filter by category</label>
                <select name="category" id="category" class="form-control" required onchange="this.form.submit()">
                    <option value="" disabled selected>--select category--</option>
                    <?php
                    foreach ($CATEGORIES as $category) { ?>
                        <option value="<?php echo $category->category; ?>"><?php echo $category->category; ?></option>
                    <?php }
                    ?>
                </select>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <table id="datable_1" class="table table-hover w-200">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Sub-Category</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($SUBCATEGORIES as $subcategory) {
                        ?>
                            <tr>
                                <td><?php echo $subcategory->id; ?></td>
                                <td><?php echo $subcategory->category; ?></td>
                                <td><?php echo $subcategory->sub_category; ?></td>
                                <td><?php echo $subcategory->added_date . ' - ' . $subcategory->added_time; ?></td>
                                <td><?php echo ($subcategory->is_active == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>'; ?></td>
                                <td>
                                    <button data-toggle="modal" data-id="<?php echo $subcategory->id; ?>" data-text="<?php echo $subcategory->sub_category; ?>" data-category="<?php echo $subcategory->category; ?>" data-target="#editSubCategory" class="btn btn-info btn-xs editButton">Edit</button>

                                    <?php if ($subcategory->is_active == 1) { ?>
                                        <a href="<?php echo site_url('admin/categorization/changeStatus/subcategories/0/' . $subcategory->id); ?>" class="btn btn-danger btn-xs">Inactive</a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url('admin/categorization/changeStatus/subcategories/1/' . $subcategory->id); ?>" class="btn btn-success btn-xs">Active</a>
                                    <?php } ?>
                                    <a href="<?php echo site_url('admin/categorization/changeStatus/subcategories/3/' . $subcategory->id); ?>" class="btn btn-danger btn-xs">Delete</a>
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

<div class="modal fade" id="editSubCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDITING <span id="editingSubCategory"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('admin/categorization/editSubCategory'); ?>" autocomplete="off">
                    <input type="hidden" id="editSubCategoryId" name="editSubCategoryId">
                    <input type="hidden" id="editCategoryText" name="editCategoryText">
                    <input type="text" id="editSubCategoryText" class="form-control" name="editSubCategoryText" required>
            </div>
            <div class="modal-footer">
                <button type="submit" name="changeCategory" class="btn btn-primary">Save changes</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    // $('#datable_1').dataTable({
    //     "autoWidth": true,
    //     searching: true,
    //     responsive: true
    // });

    // $('.editButton').on('click', function(e) {

    $(document).on('click touch', '.editButton', function() {

        var id = $(this).data('id');

        var text = $(this).data('text');

        var category = $(this).data('category');

        $('#editSubCategoryId').val(id);

        $('#editSubCategoryText').val(text);

        $('#editCategoryText').val(category);

        $('#editingSubCategory').html(text.toUpperCase());

    });
</script>