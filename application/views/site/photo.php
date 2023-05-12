<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<div class="row grey-bg">
    <div class="col-md-8 col-sm-12">
        <!-- <?= json_encode($PHOTO) ?> -->
        <?php if ($PHOTO->is_image == '1') { ?>
            <div class="photos">
                <a href="<?= base_url('/uploads/photos/' . $PHOTO->file_name) ?>" data-lightbox="photos">
                    <img class="img-fluid" src="<?= base_url('/uploads/photos/' . $PHOTO->file_name) ?>" />
                </a>
            </div>
        <?php } else { ?>
            <div id="light">
                <a class="boxclose" id="boxclose" onclick="lightbox_close();"></a>
                <video id="VisaChipCardVideo" width="600" controls>
                    <source src="<?= base_url('/uploads/videos/' . $PHOTO->file_name) ?>" type="video/mp4">
                </video>
            </div>
            <div id="fade" onClick="lightbox_close();"></div>
            <div class="showtest">
                <a onclick="lightbox_open();"><img src="<?= base_url('/uploads/thumbnails/' . $PHOTO->thumbnail_path) ?>" class="img-fluid"></a>
            </div>
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
<script>
    window.document.onkeydown = function(e) {
        if (!e) {
            e = event;
        }
        if (e.keyCode == 27) {
            lightbox_close();
        }
    }

    function lightbox_open() {
        var lightBoxVideo = document.getElementById("VisaChipCardVideo");
        var light = document.getElementById("light");
        window.scrollTo(0, 0);
        light.style.transitionDelay = "10s";
        document.getElementById('light').style.display = 'block';
        document.getElementById('fade').style.display = 'block';
        lightBoxVideo.play();
    }

    function lightbox_close() {
        var lightBoxVideo = document.getElementById("VisaChipCardVideo");
        document.getElementById('light').style.display = 'none';
        document.getElementById('fade').style.display = 'none';
        lightBoxVideo.pause();
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>