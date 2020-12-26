<?php
    class Mahasiswa extends Controller
    {
        public function index()
        {
            $data['judul'] = 'Data Mahasiswa';
            if(isset($_POST['src'])){
                $data['mhs'] = $this->model('Mahasiswa_model')->cariDataMahasiswa(htmlspecialchars($_POST['src']));
            }else{
                $data['mhs'] = $this->model('Mahasiswa_model')->getAllMahasiswa();
            }
            $this->view('templates/header', $data);
            $this->view('Mahasiswa/index', $data);
            $this->view('templates/footer');
        }

        public function detail($id)
        {
            $data['mhs'] = $this->model('Mahasiswa_model')->getMahasiswaById($id);
            $this->view('templates/header', $data);
            $this->view('Mahasiswa/detail', $data);
            $this->view('templates/footer');
        }

        public function tambah()
        {
            if ($this->model('Mahasiswa_model')->tambahDataMahasiswa($_POST) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/mahasiswa');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location:' . BASEURL . '/mahasiswa');
                exit;
            }
        }

        public function edit()
        {
            if ($this->model('Mahasiswa_model')->editDataMahasiswa($_POST) > 0) {
                Flasher::setFlash('berhasil', 'diubah', 'success');
                header('Location: ' . BASEURL . '/mahasiswa');
                exit;
            } else {
                Flasher::setFlash('gagal', 'diubah', 'danger');
                header('Location:' . BASEURL . '/mahasiswa');
                exit;
            }
        }

        public function hapus($id)
        {
            if ($this->model('Mahasiswa_model')->hapusDataMahasiswa($id) > 0) {
                Flasher::setFlash('berhasil', 'dihapus', 'success');
                header('Location: ' . BASEURL . '/mahasiswa');
                exit;
            } else {
                Flasher::setFlash('gagal', 'dihapus', 'danger');
                header('Location:' . BASEURL . '/mahasiswa');
                exit;
            }
        }
    }
