<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">ADD NEW</h5>
    <div class="row">
        <div class="col-sm">
            <form method="post" autocomplete="off" enctype="multipart/form-data" action="<?php echo site_url('admin/categorization/newCategory'); ?>">
                <div class="row">

                    <div class="col-sm-4">
                        <input type="text" name="category" placeholder="Enter category name" id="" class="form-control" required>
                    </div>

                    <div class="col-sm-4">
                        <input type="file" name="categoryImage" accept="images/*" class="form-control" id="categoryImage" required>
                    </div>

                    <div class="col-sm-4">

                        <button type="submit" name="add" class="btn btn-info">ADD</button>

                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
</section>

<section class="hk-sec-wrapper container">
    <h5 class="hk-sec-title">CATEGORIES</h5>
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
                                    <button data-toggle="modal" data-id="<?php echo $category->id; ?>" data-text="<?php echo $category->category; ?>" data-file="<?php echo base_url() . 'uploads/categories/' . $category->file_name; ?>" data-target="#editCategory" class="btn btn-info btn-xs editButton">Edit</button>

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

<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDITING <span id="editingCategory"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('admin/categorization/editCategory'); ?>" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" id="editCategoryId" name="editCategoryId">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" id="editCategoryText" class="form-control" name="editCategoryText" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="file" name="categoryImageModal" accept="images/*" class="form-control" id="categoryImageModal">
                            <br /><img src="" id="showImageModal" alt="" height="100" width="150">
                        </div>
                    </div>
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

        var file = $(this).data('file');

        $('#editCategoryId').val(id);

        $('#editCategoryText').val(text);

        $('#showImageModal').attr('src', file);

        $('#editingCategory').html(text.toUpperCase());

        $('#editType').val($(this).data('types')).change()

    });

    var imgObj = document.getElementById('categoryImage');

    imgObj.onchange = showImage;

    function showImage() {

        var tmppath = URL.createObjectURL(event.target.files[0]);

        $("#showImage").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));

    }

    var imgObj = document.getElementById('categoryImageModal');

    imgObj.onchange = showImageModalF;

    function showImageModalF() {

        var tmppath = URL.createObjectURL(event.target.files[0]);

        $("#showImageModal").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));

    }
</script>