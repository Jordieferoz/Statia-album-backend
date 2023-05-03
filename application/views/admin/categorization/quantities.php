<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">ADD NEW</h5>
    <p class="mb-40">Eg: ml, kg etc.</p>
    <div class="row">
        <div class="col-sm">
            <form method="post" autocomplete="off" action="<?php echo site_url('admin/categorization/newQuantity'); ?>">
                <div class="form-group">
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Enter quantity</span>
                        </div>

                        <input type="text" name="quantity" id="" class="form-control" required>

                        <button type="submit" name="add" class="btn btn-info">ADD</button>
                        </span>

                        </span>
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
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($QUANTITIES as $quantity) {
                        ?>
                            <tr>
                                <td><?php echo $quantity->id; ?></td>
                                <td><?php echo $quantity->quantity; ?></td>
                                <td><?php echo $quantity->added_date . ' - ' . $quantity->added_time; ?></td>
                                <td><?php echo ($quantity->is_active == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>'; ?></td>
                                <td>
                                    <button data-toggle="modal" data-id="<?php echo $quantity->id; ?>" data-text="<?php echo $quantity->quantity; ?>" data-target="#editQuantity" class="btn btn-info btn-xs editButton">Edit</button>

                                    <?php if ($quantity->is_active == 1) { ?>
                                        <a href="<?php echo site_url('admin/categorization/changeStatus/quantities/0/' . $quantity->id); ?>" class="btn btn-danger btn-xs">Inactive</a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url('admin/categorization/changeStatus/quantities/1/' . $quantity->id); ?>" class="btn btn-success btn-xs">Active</a>
                                    <?php } ?>
                                    <a href="<?php echo site_url('admin/categorization/changeStatus/quantities/3/' . $quantity->id); ?>" class="btn btn-danger btn-xs">Delete</a>
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

<div class="modal fade" id="editQuantity" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDITING <span id="editingQuantity"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('admin/categorization/editQuantity'); ?>" autocomplete="off">
                    <input type="hidden" id="editQuantityId" name="editQuantityId">
                    <input type="text" id="editQuantityText" class="form-control" name="editQuantityText" required>
            </div>
            <div class="modal-footer">
                <button type="submit" name="changeQuantity" class="btn btn-primary">Save changes</button>
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

        $('#editQuantityId').val(id);

        $('#editQuantityText').val(text);

        $('#editingQuantity').html(text.toUpperCase());

    });
</script>