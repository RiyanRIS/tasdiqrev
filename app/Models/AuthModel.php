<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
  protected $message = [];

  public function login(string $username, string $password, bool $remember = false): bool
  {
    if (empty($username) || empty($password)) {
      $this->setError("Username atau password masih ada yang kosong");
      return false;
    }

    $query = $this->db->table("admin")
      ->select('*')
      ->where('username', $username)
      ->limit(1)
      ->orderBy('id_admin', 'desc')
      ->get();

    $user = $query->getRow();

    if (isset($user)) {
      if (password_verify($password, $user->password)) {

        $this->setSession($user, true);
        $this->setMessage("Berhasil masuk");
        return true;
      } else {
        $this->setMessage("Password salah");
        return false;
      }
    } else {
      $this->setMessage("Username tidak ditemukan");
      return false;
    }
  }

  public function logout($id)
  {
    $sessionData = [
      'user_id'             => '',
      'user_nama'             => '',
      'islogin'             => false,
      'isadmin'             => false,
    ];

    session()->set($sessionData);
    return true;
  }

  public function setSession(\stdClass $user): bool
  {
    $sessionData = [
      'user_id'             => $user->id_admin,
      'user_nama'             => $user->nama,
      'islogin'             => true,
      'isadmin'             => true,
    ];

    session()->set($sessionData);

    return true;
  }

  public function setMessage(string $msg): string
  {
    $this->message[] = $msg;
    return $msg;
  }

  public function msg()
  {
    return $this->message;
  }
}
