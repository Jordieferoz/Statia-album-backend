<style>
  .photos-and-categories {
    animation: fadeInAnimation ease 1.5s;
    animation-iteration-count: 1;
    animation-fill-mode: forwards;
  }

  @keyframes fadeInAnimation {
    0% {
      opacity: 0;
    }

    100% {
      opacity: 1;
    }
  }

  .photos-and-categories {
    opacity: 0;
    transition: opacity 5s;
  }
</style>
<div class="row">
  <div class="col-md-3 col-sm-12 categories-list-block">
    <ul class="categories-list">
      <li>
        <a href="<?= base_url() ?>">
          <p class="category-single all-photos-list <?= !($this->uri->segment(3)) ? 'active' : '' ?>">Gallery</p>
        </a>
      </li>
      <?php foreach ($CATEGORIES as $category) { ?>
        <li id="category-<?= $category->id ?>">
          <a href="<?= base_url() . 'welcome/index/' . $category->id . '?c=' . preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $category->category)) ?>">
            <p class="category-single <?= ($this->uri->segment(3)) && $this->uri->segment(3) === $category->id ? 'active' : '' ?>">
              <?= $category->category ?>
            </p>
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>
  <div class="col-md-9 col-sm-12 photos-and-categories">
    <h3 class="section-title heading5 categories-list-item">
      <div class="row">
        <div class="col-6 mt-1">
          <?= !($this->uri->segment(3)) ? 'Gallery' : $CATEGORIES[array_search($this->uri->segment(3), array_column($CATEGORIES, 'id'), 'id')]->category ?>
        </div>
        <div class="col-6">
          <div class="category-menu">
            <a id="open-sidebar">
              <img id="hamburger-image" src="<?= base_url() ?>assets/site/images/hamburger_icon.svg" />
            </a>
          </div>
        </div>
      </div>
    </h3>
    <div class="row mt-3 categories-image-list">
    <?php if (!($this->uri->segment(3))) {
      $count = 0;
      foreach ($CATEGORIES as $category) {
    ?>
        <!-- <?= $count % 3 === 0 ? '<div class="row mt-3">' : '' ?> -->
        <div class="col-md-4 col-6 mt-3" style="cursor: pointer;" onclick="window.location.assign('<?= base_url('welcome/index/' . $category->id . '?c=' . preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $category->category))) ?>')">
          <div class="card category-card shadow">
            <img class="card-img-top p-2" src="<?= !$category->file_name ? base_url('assets/site/images/no-img.jpg') : base_url('uploads/categories/' . $category->file_name) ?>" alt="Category image cap">
            <div class="card-body">
              <p class="card-text category-text">
                <?= $category->category ?>
                <!-- <?= strlen($category->category) > 20 ? mb_substr(strip_tags($category->category), 0, 20) . '...' : strip_tags($category->category); ?> -->
              </p>
            </div>
          </div>
        </div>
    <?php
        // if ($count % 3 == 2) {
        //   echo '</div>';
        // }
        $count++;
      }
    } ?>
    </div>
    <div class="row">
    <?php
    if (count($PHOTOS) == 0 && ($this->uri->segment(3))) {
      echo '<div class="no-content"><center>No photos to show</center></div>';
    }
    $count = 0;
    foreach ($PHOTOS as $photo) {
    ?>
      <!-- <?= $count % 3 === 0 ? '<div class="row">' : '' ?> -->
      <div class="col-md-4 col-6 mt-3">
        <div class="mediaCard gallery clear">
          <div class="bg" alt="<?= $photo->id ?>" style="background-image: url(<?= $photo->is_image == 1 ? base_url('uploads/photos/' . $photo->file_name) : ($photo->thumbnail_path ? base_url('uploads/thumbnails/' . $photo->thumbnail_path) : base_url('assets/site/images/no-image-placeholder.png')) ?>)">
            <div class="img_header ">
              <?php if ($photo->is_image == 0) { ?>
                <img class="play_button" src="<?= base_url() ?>assets/site/images/Play button.svg" />
              <?php } ?>
            </div>
            <div class="media-content">
              <h4 class="heading2 decrease-line-height"><?= $photo->title ? $photo->title : 'No title' ?></h4>
              <h5 class="sub-heading" title="<?= strip_tags($photo->description) ?>"><?= strlen($photo->description) > 20 ? mb_substr(strip_tags($photo->description), 0, 20) . '...' : strip_tags($photo->description); ?></h5>
              <p class="supported-text media-views"><span id="image-<?= $photo->id ?>"><?= $photo->total_views == 0 ? 'No' : $photo->total_views ?></span> views</p>
            </div>
            <div class="media-card-overlay"></div>
          </div>
        </div>
      </div>
    <?php
      if ($count % 3 == 2) {
        // echo '</div>';
      }
      $count++;
    } ?>
    </div>
    <?php if (isset($links)) { ?>
      <div class="clearfix filters-container">
        <div class="text-right">
          <div class="pagination-container">
            <?php echo $links; ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<script>
  function viewPage(id) {
    window.location.href = `<?= base_url('/photo') ?>?id=${id}`
  }
</script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {

    $('.gallery > div.bg').each(function() {
      $(this).wrapAll('<a href="" data-fancybox="gallery"></a>');
    });

    $('.gallery a').each(function() {
      var link = $(this).children('.bg').css('background-image');
      console.log(link);
      link = link.replace(/(url\(|\)|")/g, '');
      $(this).attr('href', link);
    });

    $("[data-fancybox]").fancybox({
      afterLoad: function(instance, current) {
        let photoId = current.opts.$orig.find('.bg').attr('alt')//e.curr;
        debugger
        $.ajax({
          async: true,
          crossDomain: true,
          url: "<?= base_url('/welcome/updatePagination?id='); ?>" + photoId,
          type: 'GET',
          success: function(res) {
            console.log(res)
            if (res == "true") {
              let updatedValue = 0
              let views = $(`#image-${photoId}`).text()
              if (views === 'No') {
                updatedValue = 1
              } else {
                updatedValue = Number(views) + 1
                $(`#image-${photoId}`).html(updatedValue)
              }

            }
          }
        });
      },
      loop: true,
      buttons: [
        "zoom",
        "share",
        "slideShow",
        "fullScreen",
        "download",
        "thumbs",
        "close"
      ]
    });

  });
</script>