<?php
  if ($this->session->flashdata('success')) {
    echo '<div class="alert alert-success" role="alert">
            ' . $this->session->flashdata('success') . '
          </div>';
  }
  if ($this->session->flashdata('danger')) {
    echo '<div class="alert alert-danger" role="alert">
            ' . $this->session->flashdata('danger') . '
          </div>';
  }
  if ($this->session->flashdata('warning')) {
    echo '<div class="alert alert-warning" role="alert">
            ' . $this->session->flashdata('warning') . '
          </div>';
  }
  if ($this->session->flashdata('info')) {
    echo '<div class="alert alert-info" role="alert">
            ' . $this->session->flashdata('info') . '
          </div>';
  }
  ?>