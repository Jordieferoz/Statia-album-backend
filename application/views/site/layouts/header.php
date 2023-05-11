<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Statia Album</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha256-wLz3iY/cO4e6vKZ4zRmo4+9XDpMcgKOvv/zEU3OMlRo=" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url() ?>assets/site/css/styles.css" />
</head>

<body>
  <div style="min-height:100vh; display:flex; flex-direction:column; 
            justify-content:space-between;">
    <header class="header-top-fixed one-page-nav">
      <div class="container">
        <div class="logo">
          <a class="navbar-brand" href="<?= base_url() ?>">
            <img class="logo" alt="logo" src="<?= base_url() ?>assets/site/images/logo.png">
          </a>
          <a class="hamburger-icon" id="open-sidebar">
            <img src="<?= base_url() ?>assets/site/images/hamburger_icon.svg" />
          </a>
        </div>
        <div class="menu-wrapper">
          <ul class="main-menu">
            <li>
              <a class="heading5 active" href="#">
                Photos
              </a>
            </li>
            <li>
              <a class="heading5" href="#">
                Albums
              </a>
            </li>
            <?php if ($this->session->userdata('user_key')) { ?>
            <li>
              <a class="heading5" href="<?= base_url('welcome/logout') ?>">
                Logout
              </a>
            </li>
            <?php } ?>
            <li>
              <a id="open-sidebar">
                <img src="<?= base_url() ?>assets/site/images/hamburger_icon.svg" />
              </a>
            </li>
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
                      <a class="heading5 active" href="#">
                        Photos
                      </a>
                    </li>
                    <li>
                      <a class="heading5" href="#">
                        Albums
                      </a>
                    </li>
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
              <?php $this->load->view('site/layouts/error_messages') ?>
            </div>
          </div>