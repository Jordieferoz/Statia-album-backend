<div class="card-body">
    <table id="datable_1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Category</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Date published</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php

      $i = 0;

      foreach ($PUBLISHED_POSTS as $videos) {

        $description = htmlspecialchars($videos->description);

        $imagePath = base_url() . 'uploads/videos/' . $videos->file_name;

      ?>
          <tr>
            <td><?php echo ++$i; ?></td>
            <td><?php echo $videos->category_id; ?></td>
            <td><?php echo $videos->title; ?></td>
            <td>
                <button type="button" class="btn btn-info description" data-description = "<?php echo $description; ?>" data-toggle="modal" data-target="#view-description">
                  View
                </button>
            </td>
            <td><button type="button" class="btn btn-default imageShow" data-image = "<?php echo $imagePath; ?>" data-toggle="modal" data-target="#view-image">Load Video</button></td>
            <td><?php echo $videos->added_date . ' / ' . $videos->added_time; ?></td>
            <td class="project-actions text-right">
              <a class="btn btn-info btn-sm" href="<?php echo site_url('admin/videos/edit/'.$videos->id); ?>">
                  Edit
              </a>
              <a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/videos/unpublish/'.$videos->id); ?>">
                  Unpublish
              </a>
          </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <div class="modal fade" id="view-description">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Description</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id = "description-here"></div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="view-image">
    <div class="modal-dialog modal-xs">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Video</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <a href="" id = "modalImageLink" target = "_BLANK"><img src="" id = "modalImage" alt="Video" height = "90%" width = "90%"></a>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script type = "text/javascript">

      $('.description').on('click', function(e) {

        var description = $(this).data('description');

        $('#description-here').html(description);

      });

      $('.imageShow').on('click', function(e) {

        var image = $(this).data('image');

        $('#modalImage').attr('src', image);

        $('#modalImageLink').attr('href', image);

      });

  </script>