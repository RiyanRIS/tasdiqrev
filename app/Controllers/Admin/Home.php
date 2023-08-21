<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->isadmin) {
            $msg = [
                'status' => false,
                'url' => site_url("admin/login"),
                'pesan'     => 'Anda tidak berhak mengakses halaman ini',
            ];
            return json_encode($msg);
        }

        $laporan = [
            'ipa' => 2,
            'ips' => 4,
            'total' => 2,
            'lulus' => 2,
            'tidak_lulus' => 2,
        ];

        $data = [
            "laporan" => $laporan,
            "tahun_ajarans" => $this->tahunajaran->find_active(),
            "judul" => "Dashboard"
        ];

        return view('admin/home/index', $data);
        // return json_encode(['status' => true, 'pesan' => 'Berhasil masuk']);
    }
}
