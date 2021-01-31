<?php
    class Stock_model
    {

        private $table = 'tb_stock';
        private $db;
       

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAllStock() 
        {

            $this->db->query("SELECT * FROM " . $this->table);
            return $this->db->resultAll();
        }

        public function tambahDataStock($data)
        {
            $query = "INSERT INTO " . $this->table . " VALUES (NULL, :kelas, :jumlah, :harga)";
            $this->db->query($query);
            $this->db->bind('kelas', $data['kelas']);
            $this->db->bind('jumlah', $data['jumlah']);
            $this->db->bind('harga', $data['harga']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function editDataStock($data)
        {
            $query = "UPDATE " . $this->table . " SET kelas = :kelas, jumlah = :jumlah, harga = :harga WHERE " .  $this->table . '.id = :id';
            $this->db->query($query);
            $this->db->bind('id', $data['id']);
            $this->db->bind('kelas', $data['kelas']);
            $this->db->bind('jumlah', $data['jumlah']);
            $this->db->bind('harga', $data['harga']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function hapusDataStock($id)
        {
            $this->db->query("DELETE FROM " . $this->table . ' WHERE id = :id');
            $this->db->bind('id',  $id);
            $this->db->execute();
            return $this->db->rowCount();
        }

    }
