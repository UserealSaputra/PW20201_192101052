<?php
    class Stock extends Controller
    {
        public function index()
        {
            $data['judul'] = 'Input Stock';
            $data['stk'] = $this->model('Stock_model')->getAllStock();
            $this->view('templates/header', $data);
            $this->view('Stock/index', $data);
            $this->view('templates/footer');
        }

        public function check()
        {
            $data['judul'] = 'Cek Stock';
            $data['stk'] = $this->model('Stock_model')->getAllStock();
            $data['sch'] = $this->model('School_model')->getAllSchool();
            $this->view('templates/header', $data);
            $this->view('Stock/check', $data);
            $this->view('templates/footer');
        }

        public function tambah()
        {
            if ($this->model('Stock_model')->tambahDataStock($_POST) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/stock');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location:' . BASEURL . '/stock');
                exit;
            }
        }

        public function edit()
        {
            if ($this->model('Stock_model')->editDataStock($_POST) > 0) {
                Flasher::setFlash('berhasil', 'diubah', 'success');
                header('Location: ' . BASEURL . '/stock');
                exit;
            } else {
                Flasher::setFlash('gagal', 'diubah', 'danger');
                header('Location:' . BASEURL . '/stock');
                exit;
            }
        }

        public function hapus($id)
        {
            if ($this->model('Stock_model')->hapusDataStock($id) > 0) {
                Flasher::setFlash('berhasil', 'dihapus', 'success');
                header('Location: ' . BASEURL . '/stock');
                exit;
            } else {
                Flasher::setFlash('gagal', 'dihapus', 'danger');
                header('Location:' . BASEURL . '/stock');
                exit;
            }
        }
    }