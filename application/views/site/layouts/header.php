<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Statia Album</title>
  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/site/images/favicon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha256-wLz3iY/cO4e6vKZ4zRmo4+9XDpMcgKOvv/zEU3OMlRo=" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url() ?>assets/site/css/styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
</head>
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
    // document.getElementById("sidebar-close-icon").addEventListener("click", toggleMenu);
  }

  function toggleMenu() {
    var ele = document.getElementsByTagName('body')[0];
    let hamburgerImage = document.getElementById('hamburger-image')
    if (!hasClass(ele, "sidebar-menu-open")) {
      addClass(ele, "sidebar-menu-open");
      hamburgerImage.src = "<?= base_url() ?>assets/site/images/hamburger_icon_active.svg"
    } else {
      hamburgerImage.src = "<?= base_url() ?>assets/site/images/hamburger_icon.svg"
      removeClass(ele, "sidebar-menu-open");
    }
  }
  document.addEventListener('readystatechange', function() {
    if (document.readyState === "complete") {
      init();
    }
  });

  function updatePage(val) {
    if (val === 'photos') {
      window.location.assign('<?= base_url('/welcome/index') ?><?= isset($_GET['c']) ? '/' . $this->uri->segment(3) . '?c=' . $_GET['c'] : '' ?>')
    } else {
      window.location.assign('<?= base_url('/welcome/videos') ?><?= isset($_GET['c']) ? '/' . $this->uri->segment(3) . '?c=' . $_GET['c'] : '' ?>')
    }
  }
</script>

<body>
  <div id="loading">
    <img id="loading-image" src="<?= base_url() ?>assets/site/images/loader.gif" alt="Loading..." />
  </div>
  <div style="min-height:100vh; display:flex; flex-direction:column; 
            justify-content:space-between;">
    <header class="header-top-fixed one-page-nav">
      <div class="container m-0 mx-5">
        <div class="logo">
          <a class="navbar-brand" href="<?= base_url() ?>">
            <img class="logo" alt="logo" src="<?= base_url() ?>assets/site/images/logo.png">
          </a>
          <select class="page-selector" onchange="updatePage(this.value)">
            <option value="photos" <?= $this->uri->segment(2) === 'index' ? 'selected' : '' ?>>Photos</option>
            <option value="videos" <?= $this->uri->segment(2) === 'videos' ? 'selected' : '' ?>>Videos</option>
          </select>
          <div class="mob-right-icons">
            <a class="hamburger-icon" href="<?= base_url('welcome/logout') ?>">
              <img src="<?= base_url() ?>assets/site/images/logout.svg" />
            </a>
            <a class="hamburger-icon" id="open-sidebar">
              <img id="hamburger-image" src="<?= base_url() ?>assets/site/images/hamburger_icon.svg" />
            </a>
          </div>
        </div>
        <div class="menu-wrapper">
          <ul class="main-menu">
            <li>
              <a class="heading5 <?php echo $this->uri->segment(2) !== 'videos' ? 'active' : '' ?>" href="<?= base_url('/welcome/index') ?><?= isset($_GET['c']) ? '/' . $this->uri->segment(3) . '?c=' . $_GET['c'] : '' ?>">
                Photos
              </a>
            </li>
            <li>
              <a class="heading5 <?php echo $this->uri->segment(2) === 'videos' ? 'active' : '' ?>" href="<?= base_url('/welcome/videos') ?><?= isset($_GET['c']) ? '/' . $this->uri->segment(3) . '?c=' . $_GET['c'] : '' ?>">
                Videos
              </a>
            </li>
            <?php if ($this->session->userdata('user_key')) { ?>
              <li>
                <a class="heading5" href="<?= base_url('welcome/logout') ?>">
                  Logout
                </a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </header>
    <div id="sidebar-overlay"></div>
    <nav class="sidebar-menu" role="navigation">
      <div class="sidebar-content">
        <div class="sidebar-header">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="sidebar-header-content">
                  <ul class="sidebar-menu-items">
                    <li>
                      <a href="<?= base_url('/welcome/videos') ?>">
                        <p class="category-single all-photos-list <?= !($this->uri->segment(3)) ? 'active' : '' ?>" style="font-size: 23pt !important; color: black; padding-bottom: 10px;">Gallery</p>
                      </a>
                    </li>
                    <?php foreach ($CATEGORIES as $category) { ?>
                      <li>
                        <a href="<?= base_url() . 'welcome/videos/' . $category->id . '?c=' . preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $category->category)) ?>">
                          <p class="category-single <?= ($this->uri->segment(3)) && $this->uri->segment(3) === $category->id ? 'active' : '' ?>">
                            <?= $category->category ?>
                          </p>
                        </a>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <main>
      <section class="media-section">
        <div class="container">
          <div class="row">
            <div class="col-12 d-flex justify-content-center">
            </div>
          </div>