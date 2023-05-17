<div class="row">
  <div class="col-3">
    <ul class="categories-list">
      <li>
        <a href="<?= base_url() ?>">
          <p class="category-single all-photos-list <?= !isset($_GET['category']) ? 'active' : '' ?>">All Photos</p>
        </a>
      </li>
      <?php foreach ($CATEGORIES as $category) { ?>
        <li>
          <a href="<?= base_url() . '?category=' . $category->id ?>">
            <p class="category-single <?= isset($_GET['category']) && $_GET['category'] === $category->id ? 'active' : '' ?>">
              <?= $category->category ?>
            </p>
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>
  <div class="col-9">
    <h3 class="section-title heading5"><?= !isset($_GET['category']) ? 'All Photos' : $CATEGORIES[array_search($_GET['category'], array_column($CATEGORIES, 'id'), 'id')]->category ?></h3>
    <?php
    if (count($PHOTOS) == 0) {
      echo '<center>No photos to show</center>';
    }
    $count = 0;
    foreach ($PHOTOS as $photo) {
    ?>
      <?= $count % 3 === 0 ? '<div class="row">' : '' ?>
      <div class="col-md-4 sol-sm-6 col-xs-12 mt-3">
        <!-- <div class="mediaCard"> -->
        <div class="gallery clear">
          <div class="bg" style="background-image: url(<?= $photo->is_image == 1 ? base_url('uploads/photos/' . $photo->file_name) : ($photo->thumbnail_path ? base_url('uploads/thumbnails/' . $photo->thumbnail_path) : base_url('assets/site/images/no-image-placeholder.png')) ?>);">
            <div class="img_header ">
            <?php if($photo->is_image == 0) { ?>
              <img class="play_button" src="<?= base_url() ?>assets/site/images/Play button.svg" />
              <?php } ?>
            </div>

            <div class="media-content">
              <h4 class="heading2"><?= $photo->title ? $photo->title : 'No title' ?></h4>
              <h5 class="sub-heading" title="<?= $photo->orig_name ?>"><?= strlen($photo->orig_name) > 20 ? mb_substr($photo->orig_name, 0, 20) . '...' : $photo->orig_name; ?></h5>
              <p class="supported-text media-views"> <?= $photo->total_views == 0 ? 'No' : $photo->total_views ?> views</p>
            </div>
          </div>
        </div>
        <div class="media-card-overlay"></div>
        <!-- </div> -->
      </div>
    <?php
      if ($count % 3 == 2) {
        echo '</div>';
      }
      $count++;
    } ?>
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
<script>
  function hasClass(ele, cls) {
    return !!ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
  }

  function addClass(ele, cls) {
    if (!hasClass(ele, cls)) ele.className += " " + cls;
  }

  function removeClass(ele, cls) {
    if (hasClass(ele, cls)) {
      var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
      ele.className = ele.className.replace(reg, ' ');
    }
  }

  function init() {
    document.getElementById("open-sidebar").addEventListener("click", toggleMenu);
    document.getElementById("sidebar-overlay").addEventListener("click", toggleMenu);
    document.getElementById("sidebar-close-icon").addEventListener("click", toggleMenu);
  }

  function toggleMenu() {
    var ele = document.getElementsByTagName('body')[0];

    if (!hasClass(ele, "sidebar-menu-open")) {
      addClass(ele, "sidebar-menu-open");
      s
    } else {
      removeClass(ele, "sidebar-menu-open");
    }
  }
</script>