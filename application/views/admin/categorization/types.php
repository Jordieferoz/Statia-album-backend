<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">ADD NEW TYPE</h5>
    <p class="mb-40">Eg: Restaurant, Grocery etc.</p>
    <div class="row">
        <div class="col-sm">
            <form method="post" autocomplete="off" enctype="multipart/form-data" action="<?php echo site_url('admin/categorization/newType'); ?>">
                <div class="row">
                    <div class="col-sm-4">

                        <input type="text" name="type" placeholder="Enter type" id="" class="form-control" required>

                    </div>

                    <div class="col-sm-4">
                        <input type="file" name="typeImage" accept="images/*" class="form-control" id="typeImage" required>
                        <br /><img src="" id="showImage" alt="" height="100" width="150">
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

<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title"><?= $TITLE; ?></h5>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <table id="datable_1" class="table table-hover w-200">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($TYPES as $type) {
                        ?>
                            <tr>
                                <td><?php echo $type->id; ?></td>
                                <td><?php echo $type->types; ?></td>
                                <td><?php echo $type->added_date . ' - ' . $type->added_time; ?></td>
                                <td><?php echo ($type->is_active == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>'; ?></td>
                                <td>
                                    <button data-toggle="modal" data-id="<?php echo $type->id; ?>" data-text="<?php echo $type->types; ?>" data-file="<?php echo base_url() . 'uploads/types/' . $type->file_name; ?>" data-target="#editType" class="btn btn-info btn-xs editButton">Edit</button>

                                    <?php if ($type->is_active == 1) { ?>
                                        <a href="<?php echo site_url('admin/categorization/changeStatus/types/0/' . $type->id); ?>" class="btn btn-danger btn-xs">Inactive</a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url('admin/categorization/changeStatus/types/1/' . $type->id); ?>" class="btn btn-success btn-xs">Active</a>
                                    <?php } ?>
                                    <a href="<?php echo site_url('admin/categorization/changeStatus/types/3/' . $type->id); ?>" class="btn btn-danger btn-xs">Delete</a>
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

<div class="modal fade" id="editType" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDITING <span id="editingType"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('admin/categorization/editType'); ?>" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" id="editTypeId" name="editTypeId">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" id="editTypeText" class="form-control" name="editTypeText" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="file" name="typeImageModal" accept="images/*" class="form-control" id="typeImageModal">
                            <br /><img src="" id="showImageModal" alt="" height="100" width="150">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="changeType" class="btn btn-primary">Save changes</button>
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

        $('#editTypeId').val(id);

        $('#editTypeText').val(text);

        $('#showImageModal').attr('src', file);

        $('#editingType').html(text.toUpperCase());

    });

    var imgObj = document.getElementById('typeImage');

    imgObj.onchange = showImage;

    function showImage() {

        var tmppath = URL.createObjectURL(event.target.files[0]);

        $("#showImage").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));

    }

    var imgObj = document.getElementById('typeImageModal');

    imgObj.onchange = showImageModalF;

    function showImageModalF() {

        var tmppath = URL.createObjectURL(event.target.files[0]);

        $("#showImageModal").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));

    }
</script>