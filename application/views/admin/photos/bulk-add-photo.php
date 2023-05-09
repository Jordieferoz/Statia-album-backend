<div class="card-body">
    <center>Add Bulk Photos (max 10 images)</center>

  <form action="<?php echo site_url('admin/photos/addBulkPhotos'); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="inputStatus">Category</label>
      <select class="form-control custom-select" name="category" required>
        <option selected disabled>Select category</option>
        <?php foreach ($CATEGORIES as $category) { ?>
          <option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
        <?php } ?>
      </select>
      <span style="color: red;" class="text-error"><?php echo form_error('category'); ?></span>
    </div>
    <div class="form-group">
      <label for="inputClientCompany">Images (gif|jpg|png|jpeg)</label>
      <input type="file" name="coverImage[]" accept="images/*" multiple class="form-control" id="coverImage" required>
    </div>
</div>

<div class="row">
  <div class="col-4">
  </div>
  <div class="col-2">
    <input type="submit" value="Publish" class="btn btn-success float-right">
  </div>
  </form>
</div>