<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunajaranModel extends Model
{
  protected $table = 'tbl_tahunajaran';
  protected $primaryKey = 'id_tahun';

  protected $returnType     = 'array';

  protected $allowedFields = ['id_tahun', 'tahun_ajaran', 'tanggal_buka', 'tanggal_tutup', 'pengumuman', 'kuota', 'status', 'isDelete'];

  public function simpan($data)
  {
    $this->db->table($this->table)->insert($data);
    $id = $this->db->insertId($this->table);
    return $id ?? false;
  }

  public function find_active()
  {
    return $this->db->table($this->table)
      ->where('isDelete', null)
      ->orderBy('tahun_ajaran', 'DESC')
      ->get()
      ->getResultArray();
  }

  public function isActive()
  {
    $now = date('Y-m-d');
    return $this->db->table($this->table)
      ->where('tgl_buka <=', $now)
      ->where('tgl_tutup >=', $now)
      ->where('isDelete', null)
      ->limit(1)
      ->get()
      ->getRow();
  }

  public function updateStatusOff()
  {
    return $this->db->table($this->table)->update(['status' => 0]);
  }

  public function cekOff($id = 1): bool
  {
    $angkatan = $this->find();
    foreach ($angkatan as $key => $v) {
    }
    print_r($angkatan);
    return false;
  }
}
