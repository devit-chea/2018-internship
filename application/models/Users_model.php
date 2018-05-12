<?php
/**
 * This model contains the business logic and manages the persistence of users and roles
 * @copyright  Copyright (c) 2018 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      1.0.0
 */

if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * This model contains the business logic and manages the persistence of users and roles
 * It is also used by the session controller for the authentication.
 */
class Users_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {

    }

    /**
     * Get the list of users or one user
     * @param int $id optional id of one user
     * @return array record of users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getUsers($id = 0) {
        $this->db->select('users.*');
        if ($id === 0) {
            $query = $this->db->get('users');
            return $query->result_array();
        }
        $query = $this->db->get_where('users', array('users.id' => $id));
        return $query->row_array();
    }

    /**
     * Get the list of users and their roles
     * @return array record of users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getUsersAndRoles() {
        $this->db->select('users.id, active, firstname, lastname, login, email');
        $this->db->select("GROUP_CONCAT(" . $this->db->dbprefix('roles') . ".name SEPARATOR ',') as roles_list", FALSE);
        $this->db->join('roles', 'roles.id = (' . $this->db->dbprefix('users') . '.role & ' . $this->db->dbprefix('roles') . '.id)');
        $this->db->group_by($this->db->dbprefix('users') . '.id, active, firstname, lastname, login, email');
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function getCompanyData() {
        $this->db->select('*');
        $query = $this->db->get('company');
        return $query->result_array();
    }
    public function getCompanyDataDetail($companyId)
    {
        $this->db->select('*');
        $query = $this->db->get_where('company', array('id' => $companyId));
        return $query->result_array();
    }

    public function addCompany($name,$address,$phone,$description,$location,$url)
    {
        $data = array('name'=>$name,
                     'itemdescription'=>$description,
                     'postaladdress'=>$address,
                     'location'=>$location,
                     'phone'=>$phone,
                     'url'=>$url);
                     $this->db->insert('company',$data);
    }
    public function editCompany($id,$name,$address,$phone,$description,$location,$url)
    {
        $data = array('name'=>$name,
                     'itemdescription'=>$description,
                     'postaladdress'=>$address,
                     'location'=>$location,
                     'phone'=>$phone,
                     'url'=>$url);
        $this->db->where('id', $id);
        $this->db->update('company', $data);
    }
    public function deleteCompany($id)
    {
        $this->db->delete('company', array('id' => $id));
    }
    public function getTutorData()
    {
      $this->db->select("id,CONCAT(firstname,' ',lastname) AS tutorName,position");
        $query = $this->db->get('tutor');
        return $query->result_array(); 
    }
    public function getTutorDataDetail($tutorId)
    {
        $this->db->select('*');
        $query = $this->db->get_where('tutor', array('id' => $tutorId));
        return $query->result_array();  
    }
    public function addTutor($firstname,$lastname,$username,$password,$position,$sEmail,$phone)
    {
        $data = array('firstname'=>$firstname,
                     'lastname'=>$lastname,
                     'position'=>$position,
                     'username' =>$username,
                     'password' =>$password,
                     'email'=>$sEmail,
                     'phone'=>$phone,
                     'userrole_id'=>'2'
                 );
        $this->db->insert('tutor', $data);
    }
    public function editTutor($id,$firstname,$lastname,$username,$password,$position,$sEmail,$phone)
    {
        $data = array('firstname'=>$firstname,
                     'lastname'=>$lastname,
                     'username' =>$username,
                     'password' =>$password,
                     'position'=>$position,
                     'email'=>$sEmail,
                     'phone'=>$phone
                 );
        $this->db->where('id', $id);
        $this->db->update('tutor', $data);
    }
    public function deleteTutor($tutorId)
    {
        $this->db->delete('tutor', array('id' => $tutorId));
    }
    public function getSupervisorData()
    {
      $this->db->select("supervisor.id,name,CONCAT(firstname,' ',lastname) AS supervisorName");
      $this->db->from('supervisor');
      $this->db->join('company','company.id = supervisor.id');
      $query = $this->db->get();
     return $query->result_array(); 
    }
    public function viewSupervisor($sId)
    {
        $this->db->select('*');
        $this->db->from('supervisor');
        $this->db->join('company', 'company.id = supervisor.id');
        $this->db->where('supervisor.id', $sId);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function addSupervisor($company,$firstname,$lastname,$username,$password,$position,$sEmail,$phone)
    {
        $this->db->select("id");
        $this->db->from("company");
        $this->db->where('name', $company);
        $query = $this->db->get();
        $company_id = $query->result_array();
        $data = array('firstname'=>$firstname,
                     'lastname'=>$lastname,
                     'position'=>$position,
                     'id' => '2',
                     'username' =>$username,
                     'password' =>$password,
                     'email'=>$sEmail,
                     'phone'=>$phone,
                     'company_id'=>$company_id, 
                     'userrole_id'=>'3'
                 );
        $this->db->insert('supervisor', $data);
    }
    
    public function getStudentData()
    { 
     $this->db->select("s.id,s.firstname as stuFName,s.lastname as stuLName,
                            su.firstname as suFName,su.lastname as suLName,
                            c.name,
                            t.firstname as tFName,t.lastname as tLName");
     $this->db->from('supervisor su');
     $this->db->join('student s', 's.supervisor_id = su.id');
     $this->db->join('company c', 'c.id = su.company_id');
     $this->db->join('tutor t', 't.id = su.id');
    $query = $this->db->get();
     return $query->result_array(); 
    }
  /**
   * Get the list of roles or one role
   * 00000001 1  Admin
   * 00000010 2	User
   * 00000100 8	HR Officier / Local HR Manager
   * 00001000 16	HR Manager
   * 00010000 32	General Manager
   * 00100000 34	Global Manager
   * @param int $id optional id of one role
   * @return array record of roles
   * @author Benjamin BALET <benjamin.balet@gmail.com>
   */
  public function getRoles($id = 0) {
      if ($id === 0) {
          $query = $this->db->get('roles');
          return $query->result_array();
      }
      $query = $this->db->get_where('roles', array('id' => $id));
      return $query->row_array();
  }

    /**
     * Get the name of a given user
     * @param int $id Identifier of employee
     * @return string firstname and lastname of the employee
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getName($id) {
        $record = $this->getUsers($id);
        if (count($record) > 0) {
            return $record['firstname'] . ' ' . $record['lastname'];
        }
    }

    /**
     * Check if a login can be used before creating the user
     * @param string $login login identifier
     * @return bool TRUE if available, FALSE otherwise
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function isLoginAvailable($login) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Delete a user from the database
     * @param int $id identifier of the user
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function deleteUser($id) {
        $this->db->delete('users', array('id' => $id));
    }

    /**
     * Insert a new user into the database. Inserted data are coming from an HTML form
     * @return string deciphered password (so as to send it by e-mail in clear)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function setUsers() {
        //Hash the clear password using bcrypt (8 iterations)
        $password = $this->input->post('password');
        $salt = '$2a$08$' . substr(strtr(base64_encode($this->getRandomBytes(16)), '+', '.'), 0, 22) . '$';
        $hash = crypt($password, $salt);

        //Role field is a binary mask
        $role = 0;
        foreach($this->input->post("role") as $role_bit){
            $role = $role | $role_bit;
        }

        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'login' => $this->input->post('login'),
            'email' => $this->input->post('email'),
            'password' => $hash,
            'role' => $role
        );
        $this->db->insert('users', $data);
        return $password;
    }

    /**
     * Update a given user in the database. Update data are coming from an HTML form
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function updateUsers() {
        //Role field is a binary mask
        $role = 0;
        foreach($this->input->post("role") as $role_bit){
            $role = $role | $role_bit;
        }
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'login' => $this->input->post('login'),
            'email' => $this->input->post('email'),
            'role' => $role
        );
        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->update('users', $data);
        return $result;
    }

    /**
     * Update a given user in the database. Update data are coming from an HTML form
     * @param int $id Identifier of the user
     * @param string $password password in clear
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function resetPassword($id, $password) {
        //Hash the clear password using bcrypt (8 iterations)
        $salt = '$2a$08$' . substr(strtr(base64_encode($this->getRandomBytes(16)), '+', '.'), 0, 22) . '$';
        $hash = crypt($password, $salt);
        $data = array(
            'password' => $hash
        );
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    /**
     * Generate a random password
     * @param int $length length of the generated password
     * @return string generated password
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function randomPassword($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

    /**
     * Load the profile of a user from the database to the session variables
     * @param array $row database record of a user
     */
    private function loadProfile($row) {
      /*
        00000001 1  Admin
        00000100 8  HR Officier / Local HR Manager
        00001000 16 HR Manager
        = 00001101 25 Can access to HR functions
       */
        $isAdmin = FALSE;
        if (((int) $row->userrole_id & 1)) {
            $isAdmin = TRUE;
        }
        $isSuperAdmin = FALSE;
        if (((int) $row->userrole_id & 25)) {
            $isSuperAdmin = TRUE;
        }

        $newdata = array(
            'login' => $row->email,
            'id' => $row->id,
            'role' => $row->userrole_id,
            'isAdmin' => $isAdmin,
            'isSuperAdmin' => $isSuperAdmin
        );
        $this->session->set_userdata($newdata);
    }

    /**
     * Check the provided credentials and load user's profile if they are correct
     * @param string $login user login
     * @param string $password password
     * @return bool TRUE if the user is succesfully authenticated, FALSE otherwise
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function checkCredentials($login, $password) {
        $this->db->from('admin');
        $this->db->where('email', $login);
        $query = $this->db->get();
        // var_dump($query->result());die();

        if ($query->num_rows() == 0) {
            //No match found
            return FALSE;
        } else {
            $row = $query->row();
            $hash = crypt($password, $row->password);
            // var_dump($hash." ".$row->password);die();
            if ($hash == $row->password) {
                // Password does match stored password.
                $this->loadProfile($row);
                return TRUE;
            } else {
                // Password does not match stored password.
                return FALSE;
            }
        }
    }
     /**
     * Check the provided credentials and load user's profile if they are correct
     * @param int $id
     * @return bool TRUE if the user is succesfully authenticated, FALSE otherwise
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function checkUserRole($id) {
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
         if ($query->num_rows() == 0) {
             //No match found
             return FALSE;
         } else {
             $row = $query->row();
            return $row->role;
         }
        }
    /**
     * Set a user as active (TRUE) or inactive (FALSE)
     * @param int $id User identifier
     * @param bool $active active (TRUE) or inactive (FALSE)
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function setActive($id, $active) {
        $this->db->set('active', $active);
        $this->db->where('id', $id);
        return $this->db->update('users');
    }


    /**
     * Check if a user is active (TRUE) or inactive (FALSE)
     * @param string $login login of a user
     * @return bool active (TRUE) or inactive (FALSE)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function isActive($login) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->active;
        } else {
            return FALSE;
        }
    }

    /**
     * Try to return the user information from the login field
     * @param string $login Login
     * @return User data row or null if no user was found
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getUserByLogin($login) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            //No match found
            return null;
        } else {
            return $query->row();
        }
    }

    /**
     * Generate some random bytes by using openssl, dev/urandom or random
     * @param int $count length of the random string
     * @return string a string of pseudo-random bytes (must be encoded)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    protected function getRandomBytes($length) {
        if(function_exists('openssl_random_pseudo_bytes')) {
          $rnd = openssl_random_pseudo_bytes($length, $strong);
          if ($strong === TRUE)
            return $rnd;
        }
        $sha =''; $rnd ='';
        if (file_exists('/dev/urandom')) {
          $fp = fopen('/dev/urandom', 'rb');
          if ($fp) {
              if (function_exists('stream_set_read_buffer')) {
                  stream_set_read_buffer($fp, 0);
              }
              $sha = fread($fp, $length);
              fclose($fp);
          }
        }
        for ($i=0; $i<$length; $i++) {
          $sha  = hash('sha256',$sha.mt_rand());
          $char = mt_rand(0,62);
          $rnd .= chr(hexdec($sha[$char].$sha[$char+1]));
        }
        return $rnd;
    }
}
