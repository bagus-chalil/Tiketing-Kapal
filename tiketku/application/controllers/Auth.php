<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        
    }
    public function index()
    { 
      if($this->session->userdata('email')){
        redirect('user');
      }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        
        if($this->form_validation->run() == false){
            $data['title'] = 'Tiketku Login';
            $this->load->view('templates/auth_header',$data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        }else {

            $this->_login();
        } 
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' =>$email])->row_array();
        if($user){
            //jika user aktif
            if($user['is_active'] == 1){
                //cek password
                if(password_verify($password, $user['password'])){
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if($user['role_id'] == 1){
                      redirect('admin');
                    }else{
                    redirect('user');
                    }
                }else {
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Wrong password !
                    </div>');
                    redirect('auth');  
                }
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Your email in not been activated !
                </div>');
                redirect('auth');    
            }
        }else{
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
        Email is not register !
        </div>');
        redirect('auth');
        }
    }

    public function registration() 
    {
      if($this->session->userdata('email')){
        redirect('user');
      }
      $this->form_validation->set_rules('name', 'Name', 'required|trim');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',
      array(
        'is_unique' => 'This email has already register !'
      ));
      $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]',
      array(
        'matches' => 'Password dont match!',
        'min_length' => 'Password too short!'
      ));
      $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
  
      if($this->form_validation->run() == FALSE){
        $data['title'] = 'Tiketku Registration';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/registration');
        $this->load->view('templates/auth_footer');
      } else {
        $email = $this->input->post('email', true);
        $data = array(
          'name' => htmlspecialchars($this->input->post('name', true)),
          'email' => htmlspecialchars($email),
          'image' => 'default.jpg',
          'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
          'role_id' => 2,
          'is_active' => 0,
          'date_created' => time(),
        );

        //token aktivasi
        $token = bin2hex(openssl_random_pseudo_bytes(32));
        $user_token = [
          'email' => $email,
          'token' => $token,
          'date_created' => time(),
        ];
  
        $this->db->insert('user', $data);
        $this->db->insert('user_token', $user_token);
        
        $this->_sendEmail($token,'verify');

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
        Congratulations! Your account has been created.Please activate your account!
      </div>');
        redirect('auth');
      }
    }

    private function _sendEmail($token,$type)
    {
      $config =[
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_user' => 'tiketkuaktivation@gmail.com',
        'smtp_pass' => 'tiketku890',
        'smtp_port' => 465,
        'mailtype' => 'html',
        'charset' => 'utf-8',
        'newline' => "\r\n"
      ];

      $this->email->initialize($config);

      $this->email->from('tiketkuaktivation@gmail.com','Admin Tiketku');
      $this->email->to($this->input->post('email'));
      
      if($type == 'verify'){
        $this->email->subject('Verification Account Tiketku');
        $this->email->message('Click this link to verify your account 
        <a href="'.base_url().'auth/verify?email='.$this->input->post('email').
        '&token='.urlencode($token). '">Activated</a>');
      } else if($type == 'forgot'){
        $this->email->subject('Reset Password');
        $this->email->message('Click this link to reset your password : 
        <a href="'.base_url().'auth/resetpassword?email='. $this->input->post('email').
        '&token='.urlencode($token). '">Reset Password</a>');
      }


      if($this->email->send()) {
        return true;
      } else {
        echo $this->email->print_debugger();
        die;
      }
    }

      public function verify()
      {
        $email = $this->input->get('email');
        $token = $this->input->get('token');        
      
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
          $user_token =$this->db->get_where('user_token',['token' =>$token])->row_array();
           
          if ($user_token) {
            
            if(time() - $user_token['date_created'] < (60*60*24)){
              $this->db->set('is_active',1);
              $this->db->where('email',$email);
              $this->db->update('user');

              $this->db->delete('user_token',['email' =>$email]);

              $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">
              '.$email.' has been activated! Please Login
              </div>');
              redirect('auth');
            }else{

              $this->db->delete('user',['email' => $email]);
              $this->db->delete('user_token',['email' => $email]);


              $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">
              Account Activation Failed ! Token Expired
              </div>');
              redirect('auth');
            }
          } else {
            $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">
            Wrong token !
            </div>');
            redirect('auth');
          }
          }else {
          $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">
          Account Activation failed wrong email !
          </div>');
          redirect('auth');
        } 
      }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        
        $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">
        Thank You! Your Account has been logout
      </div>');
        redirect('auth');
    }
    public function blocked()
    {
      $this->load->view('auth/blocked');
    }

    public function forgotPassword()
    {
      $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        if($this->form_validation->run() === false){
        $data['title'] = 'Forgot Password';
        $this->load->view('templates/auth_header',$data);
        $this->load->view('auth/forgot-password');
        $this->load->view('templates/auth_footer');
    }else{
      $email = $this->input->post('email',true);
      $user = $this->db->get_where('user',['email' => $email,'is_active' => 1])->row_array();
    
      if($user) {
        $token = bin2hex(openssl_random_pseudo_bytes(32));
        $user_token = [
          'email' => $email,
          'token' => $token,
          'date_created' => time()
        ];
        
        $this->db->insert('user_token', $user_token);

        $this->_sendEmail($token, 'forgot');

        $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">
          Please check your email to reset your password
          </div>');
          redirect('auth/forgotpassword');

      }else{
          $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
          Email is not registered or Activated !
          </div>');
          redirect('auth/forgotpassword');
      }
    }
    }

  public function resetPassword()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user',['email' => $email])->row_array();
  
    if($user) {
      $user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
      
      if($user_token){
        $this->session->set_userdata('reset_email', $email);
        $this->changePassword();
      }else{
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
        Reset Password failed ! Wrong token.
        </div>');
        redirect('auth/forgotpassword');
      }
    
    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
          Reset Password failed ! Wrong email.
          </div>');
          redirect('auth');
    }
  }
  public function changePassword()
  {
    if($this->session->userdata('email')){
      redirect('user');
    }
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]',
      array(
        'matches' => 'Password dont match!',
        'min_length' => 'Password min 8 Character'
      ));
      $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[8]|matches[password1]',
      array(
        'min_length' => 'Password min 8 Character'
      ));
        if($this->form_validation->run() == false){
          $data['title'] = 'Reset Password';
          $this->load->view('templates/auth_header',$data);
          $this->load->view('auth/change-password');
          $this->load->view('templates/auth_footer');
        }else{
          $password = password_hash($this->input->post('password1'),PASSWORD_DEFAULT);
          $email = $this->session->userdata('reset_email');

          $this->db->set('password',$password);
          $this->db->where('email',$email);
          $this->db->update('user');

          $this->session->unset_userdata('reset_email');
          $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
          password has been change !
          </div>');
          redirect('auth');
        }
  }
}  
