<?php

namespace App\Controllers;

use App\Models\ModelUser;
use CodeIgniter\RESTful\ResourceController;
use Myth\Auth\Password;

/**
 * @property db $db
 * @property userObj $userObj
 */

class User extends ResourceController
{
  function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->userObj = new ModelUser();
  }

  /**
   * Return an array of resource objects, themselves in array format
   *
   * @return mixed
   */
  public function index()
  {
    $data['users'] = $this->userObj->getAllUsers();
    return view('user/index', $data);
  }

  /**
   * Return the properties of a resource object
   *
   * @return mixed
   */
  public function show($id = null)
  {
    //
  }

  /**
   * Return a new resource object, with default properties
   *
   * @return mixed
   */
  public function new()
  {
    $data['roles'] = $this->userObj->getAllRoles();
    return view('user/new', $data);
  }

  /**
   * Create a new resource object, from "posted" parameters
   *
   * @return mixed
   */
  public function create()
  {
    $userData = [
      'email'         => $this->request->getVar('email'),
      'username'      => $this->request->getVar('username'),
      'fullname'      => $this->request->getVar('fullname'),
      'password_hash' => Password::hash($this->request->getVar('password')),
      'active'        => 1,
    ];
    $this->db->table('users')->insert($userData);

    $roleData = [
      'group_id'      => $this->request->getVar('role'),
      'user_id'       => $this->userObj->insertID(),
    ];
    $this->db->table('auth_groups_users')->insert($roleData);

    return redirect()->to(site_url('user'))->with('success', 'Data berhasil di simpan');
  }

  /**
   * Return the editable properties of a resource object
   *
   * @return mixed
   */
  public function edit($id = null)
  {
    $users = $this->userObj->getUserById($id);
    if (is_object($users)) {
      $data['users'] = $users;
      $data['roles'] = $this->userObj->getAllRoles();

      return view('user/edit', $data);
    } else {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
  }

  /**
   * Add or update a model resource, from "posted" properties
   *
   * @return mixed
   */
  public function update($id = null)
  {
    $userData = [
      'email'         => $this->request->getVar('email'),
      'username'      => $this->request->getVar('username'),
      'fullname'      => $this->request->getVar('fullname'),
    ];
    $this->db->table('users')->where(['id' => $id])->update($userData);

    $roleData = [
      'group_id'      => $this->request->getVar('role'),
    ];
    $this->db->table('auth_groups_users')->where(['user_id' => $id])->update($roleData);

    return redirect()->to(site_url('user'))->with('success', 'Data berhasil di update');
  }

  /**
   * Delete the designated resource object from the model
   *
   * @return mixed
   */
  public function delete($id = null)
  {
    $this->db->table('users')->where(['id' => $id])->delete();
    return redirect()->to(site_url('user'))->with('success', 'Data berhasil di hapus');
  }
}
