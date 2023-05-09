<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Photos_model extends CI_Model {

    public function getCategories() {

        $this->db->where('is_active = 1');

        $data = $this->db->get('categories');

        return $data->result();

    }

    public function insertPost($data) {
        $this->db->insert('photos', $data);

        return $this->db->insert_id();

    }

    public function publishedPosts($isImage = true) {
        $this->db->where('status', 1);
        $this->db->where('is_image', $isImage ? 1 : 0);

        $data = $this->db->get('photos');

        return $data->result();

    }

    public function unpublishedPosts($isImage = true) {

        $this->db->where('status', 0);
        $this->db->where('is_image', $isImage ? 1 : 0);

        $this->db->where('user_id', $this->session->userdata('id'));

        $data = $this->db->get('photos');

        return $data->result();

    }

    public function idValidator($id) {

        $this->db->where('user_id', $this->session->userdata('id'));

        $this->db->where('id', $id);

        $data = $this->db->get('photos');

        if ($data -> num_rows() > 0) {

            return true;

        } else {

            return false;

        }


    }

    public function unpublish($id, $data) {

        $this->db->where('id', $id);

        $isSucceed = $this->db->update('photos', $data);

        if ($isSucceed === true) {

            return true;

        } else {

            return false;

        }

    }

    public function publish($id, $data) {

        $this->db->where('id', $id);

        $isSucceed = $this->db->update('photos', $data);

        if ($isSucceed === true) {

            return true;

        } else {

            return false;

        }

    }

    public function editPost($id) {

        $this->db->where('id', $id);

        $query = $this->db->get('photos');

        return $query->result();

    }

    public function updatePost($id, $data) {

        $this->db->where('id', $id);

        $query = $this->db->update('photos', $data);

        return $query;

    }

}

?>