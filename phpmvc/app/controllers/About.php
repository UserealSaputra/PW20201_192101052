<?php
    class About extends Controller
    {
        public function index($nama = 'Yusril', $pekerjaan = 'Programmer')
        {
            // echo "Halo, nama saya $nama, saya adalah seorang $pekerjaan";
            $data['nama'] = $nama;
            $data['pekerjaan'] = $pekerjaan;
            $data['judul'] = 'About Me';
            $this->view('templates/header', $data);
            $this->view('about/index', $data);
            $this->view('templates/footer');
        }

        public function page()
        {
            // echo 'about/page'; //sementara mencetak ini
            $data['judul'] = 'Pages';
            $this->view('templates/header', $data);
            $this->view('about/page');
            $this->view('templates/footer');
        }
    }