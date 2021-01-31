<?php
    class School extends Controller
    {
        public function index()
        {
            $data['judul'] = 'Data Distribusi';
            $data['sch'] = $this->model('School_model')->getAllSchool();
            $data['stk'] = $this->model('Stock_model')->getAllStock();

            $this->view('templates/header', $data);
            $this->view('School/index', $data);
            $this->view('templates/footer');
        }

        public function tambah()
        {
            if ($this->model('School_model')->tambahDataSchool($_POST) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/school');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location:' . BASEURL . '/school');
                exit;
            }
        }

        public function edit()
        {
            if ($this->model('School_model')->editDataSchool($_POST) > 0) {
                Flasher::setFlash('berhasil', 'diubah', 'success');
                header('Location: ' . BASEURL . '/school');
                exit;
            } else {
                Flasher::setFlash('gagal', 'diubah', 'danger');
                header('Location:' . BASEURL . '/school');
                exit;
            }
        }

        public function hapus($id)
        {
            if ($this->model('School_model')->hapusDataSchool($id) > 0) {
                Flasher::setFlash('berhasil', 'dihapus', 'success');
                header('Location: ' . BASEURL . '/school');
                exit;
            } else {
                Flasher::setFlash('gagal', 'dihapus', 'danger');
                header('Location:' . BASEURL . '/school');
                exit;
            }
        }
    }