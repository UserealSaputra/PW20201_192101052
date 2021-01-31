<?php
    class School_model
    {

        private $table = 'tb_school';
        private $db;
       

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAllSchool() 
        {

            $this->db->query("SELECT * FROM " . $this->table);
            return $this->db->resultAll();
        }

        public function tambahDataSchool($data)
        {
            $query = "INSERT INTO " . $this->table . " VALUES (NULL, :nama, :kelas, :jumlah, :bayar)";
            $this->db->query($query);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('kelas', $data['kelas']);
            $this->db->bind('jumlah', $data['jumlah']);
            $this->db->bind('bayar', $data['bayar']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function editDataSchool($data)
        {
            $query = "UPDATE " . $this->table . " SET nama = :nama, kelas = :kelas, jumlah = :jumlah, bayar = :bayar WHERE " .  $this->table . '.id = :id';
            $this->db->query($query);
            $this->db->bind('id', $data['id']);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('kelas', $data['kelas']);
            $this->db->bind('jumlah', $data['jumlah']);
            $this->db->bind('bayar', $data['bayar']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function hapusDataSchool($id)
        {
            $this->db->query("DELETE FROM " . $this->table . ' WHERE id = :id');
            $this->db->bind('id',  $id);
            $this->db->execute();
            return $this->db->rowCount();
        }

    }
