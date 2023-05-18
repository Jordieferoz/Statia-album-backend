<?php
  if ($this->session->flashdata('success')) {
    echo '<div class="msg msg-success" role="msg">
            ' . $this->session->flashdata('success') . '
          </div>';
  }
  if ($this->session->flashdata('danger')) {
    echo '<div class="msg msg-danger" role="msg">
            ' . $this->session->flashdata('danger') . '
          </div>';
  }
  if ($this->session->flashdata('warning')) {
    echo '<div class="msg msg-warning" role="msg">
            ' . $this->session->flashdata('warning') . '
          </div>';
  }
  if ($this->session->flashdata('info')) {
    echo '<div class="msg msg-info" role="msg">
            ' . $this->session->flashdata('info') . '
          </div>';
  }
  ?>