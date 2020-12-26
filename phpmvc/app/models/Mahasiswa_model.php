<?php
    class Mahasiswa_model
    {
        // private $dbh;
        // private $stmt;

        // private $mhs = [
        //     [
        //         "nama" => "Fajar Septian",
        //         "nim" => "0409098901",
        //         "email" => "fajarseptian45@gmail.com",
        //         "jurusan" => "Teknik Informatika"
        //     ],
        //     [
        //         "nama" => "Imam Shalahudin",
        //         "nim" => "0317076801",
        //         "email" => "shalahudinhasby@gmail.com",
        //         "jurusan" => "Teknik Industri"
        //     ],
        //     [
        //         "nama" => "Juli Yanto",
        //         "nim" => "0321077201",
        //         "email" => "juli.tomoko@gmail.com",
        //         "jurusan" => "Teknik Mesin"
        //     ]
        // ];

        private $table = 'mahasiswa';
        private $db;
       

        public function __construct()
        {
            //$dsn = data source name
            // $dsn = "mysql:host=localhost; dbname=phpmvc";
            // try {
            //     $this->dbh = new PDO($dsn, 'root', '');
            // } catch (PDOException $e) {
            //     die($e->getMessage());
            // }

            $this->db = new Database;
        }

        public function getAllMahasiswa() //method utk mendapatkan data mhs
        {
            // return $this->mhs;

            // $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
            // $this->stmt->execute();
            // return $this->stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->db->query("SELECT * FROM " . $this->table);
            return $this->db->resultAll();
        }

        public function getMahasiswaById($id) //method utk mendapatkan 1 data mhs
        {
            $this->db->query("SELECT * FROM " . $this->table . ' WHERE id = :id');
            $this->db->bind('id',  $id);
            return $this->db->resultSingle();
        }

        public function cariDataMahasiswa($nama)
        {
            $this->db->query("SELECT * FROM " . $this->table . " WHERE nama LIKE '%" . $nama . "%'");
            return $this->db->resultAll();
        }

        public function tambahDataMahasiswa($data)
        {
            $query = "INSERT INTO " . $this->table . " VALUES (NULL, :nama, :nim, :email, :jurusan)";
            $this->db->query($query);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('nim', $data['nim']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('jurusan', $data['jurusan']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function editDataMahasiswa($data)
        {
            $query = "UPDATE " . $this->table . " SET nama = :nama, nim = :nim, email = :email, jurusan = :jurusan WHERE " .  $this->table . '.id = :id';
            $this->db->query($query);
            $this->db->bind('id', $data['id']);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('nim', $data['nim']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('jurusan', $data['jurusan']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function hapusDataMahasiswa($id)
        {
            $this->db->query("DELETE FROM " . $this->table . ' WHERE id = :id');
            $this->db->bind('id',  $id);
            $this->db->execute();
            return $this->db->rowCount();
        }

    }
