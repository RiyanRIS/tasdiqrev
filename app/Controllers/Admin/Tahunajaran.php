<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class TahunAjaran extends BaseController
{
  public function get(string $id)
  {
    if (!session()->isadmin) {
      $msg = [
        'status' => false,
        'url' => site_url("admin/login"),
        'pesan'     => 'Anda tidak berhak mengakses halaman ini',
      ];
      return json_encode($msg);
    }

    $hasil = $this->tahunajaran->find($id);

    echo json_encode($hasil);
  }

  public function tambah(string $id = null)
  {
    if (!session()->isadmin) {
      $msg = [
        'status' => false,
        'url' => site_url("admin/login"),
        'pesan'     => 'Anda tidak berhak mengakses halaman ini',
      ];
      return json_encode($msg);
    }

    $rules = [
      'tahun_ajaran' => [
        'label'  => 'Tahun Ajaran',
        'rules'  => 'required',
        'errors' => [],
      ]
    ];
    $this->validation->setRules($rules);

    if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
      $additionalData = $this->request->getPost();
      unset($additionalData['id']);

      if ($id == null) {
        $lastid = $this->tahunajaran->simpan($additionalData);
      } else {
        $lastid = $this->tahunajaran->update(['id_tahun', $id], $additionalData);
      }

      if ($lastid) {
        $msg = [
          'status' => true,
          'url' => site_url("admin"),
        ];
      } else {
        $msg = [
          'status' => false,
          'url' => site_url("admin"),
          'pesan'     => 'Data gagal dirubah',
        ];
      }
    } else {
      $msg = [
        'status' => false,
        'errors' => $this->validation->getErrors(),
      ];
    }
    echo json_encode($msg);
    die();
  }

  public function hapus(string $id)
  {
    if (!session()->isadmin) {
      $msg = [
        'status' => false,
        'url' => site_url("admin/login"),
        'pesan'     => 'Anda tidak berhak mengakses halaman ini',
      ];
      return json_encode($msg);
    }

    $hapus = $this->tahunajaran->update(['id_tahun', $id], ['isDelete' => 1]);

    $msg = ($hapus ? [1, "Berhasil menghapus data"] : [0, "Gagal menghapus data"]);

    return redirect()->to(site_url('admin'))->with('msg', $msg);
  }
}
