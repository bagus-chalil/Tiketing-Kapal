<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("M_User");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
        
    }
    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->form_validation->set_rules('current_password', 'Current Password','trim|required');
        $this->form_validation->set_rules('new_password1', 'New Password','trim|required|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password','trim|required|min_length[3]|matches[new_password1]');

        if($this->form_validation->run() == FALSE){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/changepassword', $data);
        $this->load->view('templates/footer');
        }else{
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if(password_verify($current_password,$data['user']['password'])){
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Wrong Current Password!
                </div>');
                redirect('user/changepassword');
            } else{
                if($current_password ==$new_password){
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Wrong Current Password!
                    </div>');
                    redirect('user/changepassword');
                }else {
                    $password_hash = password_hash($new_password,PASSWORD_DEFAULT);
                    
                    $this->db->set('password',$password_hash);
                    $this->db->where('email',$this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                    Password has been Change!
                    </div>');
                    redirect('user/changepassword');

                }
            }
        }
        
    }
    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->form_validation->set_rules('name', 'FULL NAME', 'trim|required');

        if($this->form_validation->run() == FALSE){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/edit',$data);
        $this->load->view('templates/footer');
       }else {
           $email = $this->input->post('email');
           $name = $this->input->post('name');

           //cek gambar
           $upload_image =$_FILES['image']['name'];

           if($upload_image) {
            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '5024';

            $this->load->library('upload',$config);

            if ($this->upload->do_upload('image')){
                $old_image =$data['user']['image'];
                if($old_image != 'default.jpg'){
                    unlink(FCPATH .'assets/img/profile/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            }else{
                echo $this->upload->display_errors();
            }
        }

           $this->db->set('name',$name);
           $this->db->where('email',$email);
           $this->db->update('user');

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
        Profile has been Update!
        </div>');
        redirect('user');
       }
    }

    public function tiket()
    {
        $data['title'] = 'Reservasi Tiket';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pelabuhan'] = $this->M_User->getDataPelabuhan()->result();
        
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/tiket',$data);
        $this->load->view('templates/footer');

    }
  
    public function cari_tiket()
    {
		
		
		//$data['penumpang'] = $this->input->post('jumlah');
        
        $tiket = $this->M_User->cari_tiket()->result_array();
		$data['title'] = 'Reservasi Tiket';
		$data['pelabuhan'] = $this->M_User->getDataPelabuhan()->result();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/tiket',$data);
        $this->load->view('templates/footer');
        
    }
    public function cari_tiket_ok ()
    {
        $data = array(
			'asal' => $this->input->post('asal'), 
			'tujuan' => $this->input->post('tujuan'),
			'status' => 0
		);
		
        $data['hasil_pencarian']  = $this->M_User->cari_tiket($data)->result();
        $data['title'] = 'Reservasi Tiket OK';
		$data['pelabuhan'] = $this->M_User->getDataPelabuhan()->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['penumpang'] = $this->input->post('jumlah');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hasil_pencarian',$data);
        $this->load->view('templates/footer');
    }
    public function pembayaran()
    {
        $data['title'] = 'Pembayaran';
		$data['pelabuhan'] = $this->M_User->getDataPelabuhan()->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if(isset($_GET['kode'])):
            $kode = $_GET['kode'];
            $data['no_tiket']= $this->M_User->getPembayaranWhere($kode)->row();
            $data['detail'] = $this->M_User->cekKonfirmasi($data['no_tiket']->no_tiket)->result();

        endif;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pembayaran',$data);
        $this->load->view('templates/footer');   
    }
    public function pesan($id)
    {
        $data['title'] = 'Formulir Data Diri';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id_jadwal'] = $id;
        $data['info'] =$this->M_User->getDataInfoPesan($id)->row(); 

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/formulir',$data);
        $this->load->view('templates/footer');     
    }
    public function pesanTiket()
    {
        $penumpang = $this->input->post('penumpang');
        $harga = $this->input->post('harga');
        //Nomor Pembayaran
        $cek = $this->M_User->getPembayaran()->num_rows()+1;
        $no_pembayaran = 'PMBYR001' .$cek;
        $total_pembayaran =$penumpang*$harga;

        //input pembayaran
        $no_tiket = 'TK00' .$cek;

        $data = array(
            'no_pembayaran' => $no_pembayaran,
            'no_tiket' => $no_tiket,
            'total_pembayaran' => $total_pembayaran,
            'status' => 0
        );

        $this->M_User->insertPembayaran($data);

        //Nomor Tiket
        $cek = $this->M_User->getTiket()->num_rows()+1;
        

        //input data Penumpang
        for ($i=1; $i<=$penumpang; $i++)
        {
            $data = array(
                'nomor_tiket' =>$no_tiket,
                'nama' =>$this->input->post('nama'.$i),
                'no_identitas' =>$this->input->post('identitas'.$i),
            );
            $this->M_User->insertPenumpang($data);
            
        }
        //input data Pemesan
        $data = array(
            'nomor_tiket' =>$no_tiket,
            'id_jadwal' =>$this->input->post('id_jadwal'),
            'nama_pemesan' => $this->input->post('nama_pemesan') ,
            'email' => $this->input->post('email') ,
            'no_telephone' => $this->input->post('no_telp') ,
            'alamat' => $this->input->post('alamat') ,
            'tanggal' => date('Y-m-d h:i:s')
        );
        $this->M_User->insertPemesan($data);

        $this->session->set_flashdata('nomor', $no_pembayaran);
        $this->session->set_flashdata('total', $total_pembayaran);
        redirect('user/keHalamanPembayaran',$total_pembayaran);
    }
    public function keHalamanPembayaran()
    {
        
        $data['title'] = 'Halaman Cek Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pelabuhan'] = $this->M_User->getDataPelabuhan()->result();
        
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/booking');
        $this->load->view('templates/footer');
        
    }

    public function cekKonfirmasi()
    {
        $kode = $this->input->post('kode');
        
      
        
        redirect('user/pembayaran?kode='.$kode);
    }
    public function kirimKonfirmasi()
    {
        $config['upload_path'] = './assets/bukti/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '5120';
        $config['max_width']    = '1024';
        $config['max_height']   = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('gambar')){
                $error = array('error' => $this->upload->display_errors());

                redirect('user/pembayaran', $error);
        }else{
                $data = $this->upload->data();
                $filename = $data['file_name'];
                $no = $this->input->post('no_pembayaran');
                $this->M_User->insertBukti($filename, $no);

                $this->session->set_flashdata('pesan', 'Berhasil Mengirim Bukti,
                Pembayaran akan terkonfirmasi maksimal 1x24 Jam');
                redirect('user/pembayaran');
        }
    }
    public function cetakTiket()
    {
        $no_tiket = $this->input->post('no_tiket');

        $data['detail'] = $this->M_User->getPrint($no_tiket)->row();
        $data['jml_penumpang'] = $this->M_User->cekKonfirmasi($no_tiket)->num_rows();
        
        $data['title'] = 'Cetak Tiket';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('print',$data);
        $this->load->view('templates/footer');
    }
}
