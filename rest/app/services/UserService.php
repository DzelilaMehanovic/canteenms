<?php
class UserService {

    private $user_dao;

    public function __construct() {
        $this->user_dao = new UserDao();
    }

    public function login($user){
      $db_user = $this->get_user_by_email($user['user_email']);
      $is_admin = false;
      if($db_user){
        //UPDATE PASSWORD VERIFICATION
        if($db_user['password'] == $user['psword']){
          if($db_user['type'] == 'employee'){
            $employee_dao = new EmployeeDao();
            $db_user = $employee_dao->get_by_id($db_user['id']);
          } else if($db_user['type'] == 'customer'){
            $customer_dao = new CustomerDao();
            $db_user = $customer_dao->get_by_id($db_user['id']);
          } else if($db_user['type'] == 'admin'){
            $admin_dao = new AdminDao();
            $db_user = $admin_dao->get_by_id($db_user['id']);
            $is_admin = true;
          }

          $token_data = [
            'id' => $db_user['id'],
            'email' => $db_user['email'],
            'name' => $db_user['name'],
            'is_admin' => $is_admin
          ];

          $jwt = Auth::encode_jwt($token_data);
          Flight::json(['user_token' => $jwt]);
        } else {
          Flight::halt(404, 'Password is not correct');
        }
      } else {
        Flight::halt(404, 'User not found');
      }
    }

    public function get_user_by_email($user_email){
      $user = $this->user_dao->get_user_by_email($user_email);
      return $user;
    }

    public function add_user($user){
      $user_id = $this->user_dao->add($user);

      return $user_id;
    }


}
