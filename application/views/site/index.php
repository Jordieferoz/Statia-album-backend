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
  <div class="col-md-3 col-sm-12">
    <ul class="categories-list">
      <li>
        <a href="<?= base_url() ?>">
          <p class="category-single all-photos-list <?= !($this->uri->segment(3)) ? 'active' : '' ?>">All Photos</p>
        </a>
      </li>
      <?php foreach ($CATEGORIES as $category) { ?>
        <li>
          <a href="<?= base_url() . 'welcome/index/' . $category->id ?>">
            <p class="category-single <?= ($this->uri->segment(3)) && $this->uri->segment(3) === $category->id ? 'active' : '' ?>">
              <?= $category->category ?>
            </p>
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>
  <div class="col-md-9 col-sm-12 photos-and-categories">
    <h3 class="section-title heading5"><?= !($this->uri->segment(3)) ? 'All Photos' : $CATEGORIES[array_search($this->uri->segment(3), array_column($CATEGORIES, 'id'), 'id')]->category ?></h3>
    <?php if (!($this->uri->segment(3))) {
      $count = 0;
      foreach ($CATEGORIES as $category) {
    ?>
        <?= $count % 3 === 0 ? '<div class="row">' : '' ?>
        <div class="col-md-4 sol-sm-6 col-xs-12 p-2" style="cursor: pointer;" onclick="window.location.assign('<?= base_url('welcome/index/' . $category->id) ?>')">
          <div class="card category-card shadow">
            <img class="card-img-top p-2" src="<?= !$category->file_name ? base_url('assets/site/images/no-img.jpg') : base_url('uploads/categories/' . $category->file_name) ?>" alt="Category image cap">
            <div class="card-body">
              <p class="card-text">
                <center>
                  <p><?= $category->category ?></p>
                </center>
              </p>
            </div>
          </div>
        </div>
    <?php
        if ($count % 3 == 2) {
          echo '</div>';
        }
        $count++;
      }
    } ?>
    <?php
    if (count($PHOTOS) == 0 && ($this->uri->segment(3))) {
      echo '<center>No photos to show</center>';
    }
    $count = 0;
    foreach ($PHOTOS as $photo) {
    ?>
      <?= $count % 3 === 0 ? '<div class="row">' : '' ?>
      <div class="col-md-4 sol-sm-6 col-xs-12 py-2">
        <div class="mediaCard gallery clear">
          <div class="bg" style="background-image: url(<?= $photo->is_image == 1 ? base_url('uploads/photos/' . $photo->file_name) : ($photo->thumbnail_path ? base_url('uploads/thumbnails/' . $photo->thumbnail_path) : base_url('assets/site/images/no-image-placeholder.png')) ?>)">
            <div class="img_header ">
              <?php if ($photo->is_image == 0) { ?>
                <img class="play_button" src="<?= base_url() ?>assets/site/images/Play button.svg" />
              <?php } ?>
            </div>
            <div class="media-content">
              <h4 class="heading2 decrease-line-height"><?= $photo->title ? $photo->title : 'No title' ?></h4>
              <h5 class="sub-heading" title="<?= $photo->orig_name ?>"><?= strlen($photo->orig_name) > 20 ? mb_substr($photo->orig_name, 0, 20) . '...' : $photo->orig_name; ?></h5>
              <p class="supported-text media-views"> <?= $photo->total_views == 0 ? 'No' : $photo->total_views ?> views</p>
            </div>
            <div class="media-card-overlay"></div>
          </div>
        </div>
      </div>
    <?php
      if ($count % 3 == 2) {
        echo '</div>';
      }
      $count++;
    } ?>
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