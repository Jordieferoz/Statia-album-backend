<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Photos_model extends CI_Model {

    public function getCategories() {

        $this->db->where('is_active = 1')->order_by('category', 'asc');

        $data = $this->db->get('categories');

        return $data->result();

    }

    public function insertPost($data) {
        $this->db->insert('photos', $data);

        return $this->db->insert_id();

    }

    public function publishedPosts($isImage = true) {
        $data = $this->db->from('photos')
            ->select('photos.*, categories.category')
            ->where('status', 1)
            ->where('is_image', $isImage ? 1 : 0)
            ->join('categories', 'photos.category_id = categories.id')
            ->order_by('photos.added_timestamp', 'asc')
            ->get();
        return $data->result();

    }

    public function unpublishedPosts($isImage = true) {

        $data = $this->db->from('photos')
            ->select('photos.*, categories.category')
            ->where('status', 0)
            ->where('is_image', $isImage ? 1 : 0)
            ->join('categories', 'photos.category_id = categories.id')
            ->get();
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

    public function getSingleRecord($id) {

        $this->db->where('user_id', $this->session->userdata('id'));

        $this->db->where('id', $id);

        $data = $this->db->get('photos');

        if ($data -> num_rows() > 0) {

            return $data->result();

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