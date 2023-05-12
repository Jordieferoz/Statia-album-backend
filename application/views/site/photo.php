<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-lightbox/0.6.1/bootstrap-lightbox.css"> -->
<div class="row grey-bg">
    <div class="col-md-8 col-sm-12">
        <!-- <?= json_encode($PHOTO) ?> -->
        <?php if ($PHOTO->is_image == '1') { ?>
            <a href="<?= base_url('/uploads/photos/' . $PHOTO->file_name) ?>" data-toggle="lightbox">
                <img src="<?= base_url('/uploads/photos/' . $PHOTO->file_name) ?>" class="img-fluid">
            </a>
        <?php } else { ?>
            <a href="<?= base_url('/uploads/videos/' . $PHOTO->file_name) ?>" data-toggle="lightbox">
                <img src="<?= base_url('/uploads/thumbnails/' . $PHOTO->thumbnail_path) ?>" class="img-fluid">
            </a>
        <?php } ?>
    </div>
    <div class="col-md-4 col-sm-12">
        <table class="photo-view-table">
            <tbody>
                <tr>
                    <th>Filename:</th>
                    <td><?= $PHOTO->client_name ?></td>
                </tr>
                <tr>
                    <th>Views:</th>
                    <td><?= $PHOTO->total_views == '0' ? 'No' : $PHOTO->total_views ?> <?= $PHOTO->total_views === '1' ? 'view' : 'views' ?></td>
                </tr>
                <tr>
                    <th>ID:</th>
                    <td><?= $PHOTO->id ?></td>
                </tr>
                <tr>
                    <th>Title:</th>
                    <td><?= $PHOTO->title == '' ? '-' : $PHOTO->title ?></td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td><?= $PHOTO->description ?></td>
                </tr>
                <tr>
                    <th>Added on:</th>
                    <td><?= $PHOTO->added_date ?></td>
                </tr>
                <tr>
                    <th>File type:</th>
                    <td><?= str_replace('.', '', $PHOTO->file_ext) ?></td>
                </tr>
                <?php if ($PHOTO->is_image) { ?>
                    <tr>
                        <th>Resolution:</th>
                        <td><?= $PHOTO->image_height ?> x <?= $PHOTO->image_width ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-lightbox/0.6.1/bootstrap-lightbox.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>