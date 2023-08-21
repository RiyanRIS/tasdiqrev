<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $tahunajarans = $this->tahunajaran->find_active();
        $date_now = "2023-07-21";
        // $date_now = date('Y-m-d');
        $tahunajaran = tahun_ajaran_aktif($tahunajarans, $date_now);
        $status = "Bukan periode pendaftaran";

        if (!$tahunajaran) {
            echo "a";
        }

        $data = [
            'tahunajaran' => $tahunajaran,
        ];

        var_dump($data);
        die();

        // print_r($tahunajaran);
        // die();
        return view('index', $data);
    }
}
