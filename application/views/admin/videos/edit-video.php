<div class="card-body">

<?php

foreach ($POST_DETAILS as $post) {

    $thisId = $post->id;
    $title = $post->title;
    $description = $post->description;
    $category = $post->category_id;
    $videoPath = $post->file_name;
}
?>

<form action="<?php echo site_url('admin/videos/updateVideo'); ?>" method="post" enctype = "multipart/form-data">
  <div class="form-group">
    <label for="inputName">Title</label>
    <input type="text" id="title" name = "title" class="form-control" required value = "<?php echo $title; ?>">
    <span style = "color: red;" class = "text-error"><?php echo form_error('description'); ?></span>
  </div>
  <div class="form-group">
    <label for="inputDescription">Description</label>
    <textarea class="tinymce" name = "description" placeholder="Write your description here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $description; ?></textarea>
    <span style = "color: red;" class = "text-error"><?php echo form_error('description'); ?></span>
  </div>
  <div class="form-group">
    <label for="inputStatus">Category</label>
    <select class="form-control custom-select" name = "category" required>
      <option disabled>Select category</option>
      <?php foreach ($CATEGORIES as $categoryAll) { ?>
          <option value="<?php echo $categoryAll->id; ?>" <?php echo ($category == $categoryAll->category) ? 'selected' : ''; ?>><?php echo $categoryAll->category; ?></option>
      <?php } ?>
    </select>
    <span style = "color: red;" class = "text-error"><?php echo form_error('category'); ?></span>
  </div>
  <div class="form-group">
    <label for="inputClientCompany">Thumbnail (gif | jpg | png | jpeg)</label>
    <input type="file" name="thumbnailImage" accept="images/*" class="form-control" id="thumbnailImage">
    <span style="color: red;" class="text-error"><?php echo isset($error['error']) ? $error['error'] : ''; ?></span>
  </div>
  <div class="form-group">
    <label for="inputClientCompany">Video (mp4)</label>
    <input type="file" name="coverVideo" accept = "videos/*" class = "form-control" id="coverVideo">
    <span style = "color: red;" class = "text-error"><?php echo isset($error['error']) ? $error['error'] : ''; ?></span>
  </div>
</div>

<div class="row">
  <div class="col-4">
  </div>
  <div class="col-2">
    <input type="submit" value="Save changes" class="btn btn-success float-right">
  </div>
  <div class="col-2">
    <a href = "<?php echo site_url('admin/videos/published'); ?>" class="btn btn-secondary">Cancel</a>
  </div>
  <input type="hidden" name="thisId" value = "<?php echo $thisId; ?>">
</form>
</div>