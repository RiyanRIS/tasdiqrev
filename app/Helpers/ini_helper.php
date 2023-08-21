<?php

function is_login(): bool
{
  // print_r($_SESSION);
  if ($_SESSION['islogin']) {
    return true;
  } else {
    return false;
  }
}

function tahun_ajaran_aktif($tahunajaran, $date_now)
{
  $result = false;
  foreach ($tahunajaran as $key => $v) {
    if ($v['tanggal_buka'] <= $date_now && $v['tanggal_tutup'] >= $date_now) {
      $result = $v;
    }
  }
  return $result;
}
