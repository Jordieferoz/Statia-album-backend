<div class="card-body">

  <form action="<?php echo site_url('admin/photos/newPhoto'); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="inputName">Title</label>
      <input type="text" id="title" name="title" class="form-control" required value="<?php echo set_value('title'); ?>">
      <span style="color: red;" class="text-error"><?php echo form_error('description'); ?></span>
    </div>
    <div class="form-group">
      <label for="inputDescription">Description</label>
      <textarea class="tinymce" id="inputDescription" name="description" placeholder="Write your blog description here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo set_value('description'); ?></textarea>
      <span style="color: red;" class="text-error"><?php echo form_error('description'); ?></span>
    </div>
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
      <label for="inputClientCompany">Image</label>
      <input type="file" name="coverImage" accept="images/*" class="form-control" id="coverImage" required>
      <span style="color: red;" class="text-error"><?php echo isset($error['error']) ? $error['error'] : ''; ?></span>
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
<script type="text/javascript">
  var imgObj = document.getElementById('coverImage');

  imgObj.onchange = showImage;

  function showImage() {

    var tmppath = URL.createObjectURL(event.target.files[0]);

    $("#showImage").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));

  }
</script>