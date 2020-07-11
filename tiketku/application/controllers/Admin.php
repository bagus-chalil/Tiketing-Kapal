<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("M_Admin");
    }

    public function index()
    {
        $data['title'] = 'Admin Tiketku';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
        
    }
    public function pelabuhan()
    {
        $data['title'] = 'Tabel Pelabuhan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pelabuhan'] = $this->M_Admin->getDataPelabuhan()->result();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/list_pelabuhan',$data);
        $this->load->view('templates/footer');
        
    }
    public function tambah_pelabuhan()
    {
        $nama =$this->input->post('pelabuhan');
        $input = $this->M_Admin->tambah_pelabuhan($nama);
        redirect(base_url('admin/pelabuhan'));
    }
    public function hapus_pelabuhan($id)
    {
        $delete = $this->M_Admin->delete_pelabuhan($id);
        redirect(base_url('admin/pelabuhan'));
    }
    public function tambah_jadwal()
    {
        $data['jadwal'] = $this->M_Admin->getJadwal()->result();
        $data['title'] = 'Tabel Jadwal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pelabuhan'] = $this->M_Admin->getDataPelabuhan()->result();
        
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/list_jadwal',$data);
        $this->load->view('templates/footer');
    }

    public function tambah_jadwal_ok()
    {
        $data = array(
            'nama_kapal' => $this->input->post('nama_kapal'),
            'asal' => $this->input->post('asal'),
            'tujuan' => $this->input->post('tujuan'),
            'tgl_berangkat' => $this->input->post('tgl_berangkat'),
            'tgl_sampai' => $this->input->post('tgl_sampai'),
            'kelas' => $this->input->post('kelas'),
            'harga' => $this->input->post('harga')
        );
        
        $this->M_Admin->tambah_jadwal($data);
        redirect('admin/tambah_jadwal');
    }
    public function hapus_jadwal($id)
    {
        $delete = $this->M_Admin->delete_jadwal($id);
        redirect(base_url('admin/tambah_jadwal'));
    }
    public function edit_jadwal($id)
    {
        $data['data_edit'] = $this->M_Admin->getDataEditJadwal($id)->row();
        $data['title'] = 'Tabel Data';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pelabuhan'] = $this->M_Admin->getDataPelabuhan()->result();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_data' ,$data);
        $this->load->view('templates/footer');
    }
    public function ubah_jadwal()
    {
        $data = array (
            'nama_kapal' => $this->input->post('nama_kapal'),
            'asal' => $this->input->post('asal'),
            'tujuan' => $this->input->post('tujuan'),
            'tgl_berangkat' => $this->input->post('tgl_berangkat'),
            'tgl_sampai' => $this->input->post('tgl_sampai'),
            'kelas' => $this->input->post('kelas'),
            'harga' => $this->input->post('harga')
        );

        $this->M_Admin->ubah_jadwal($data);
        redirect(base_url('admin/tambah_jadwal'));
    }
    public function konfirmasiPembayaran()
    {
        $data['list'] = $this->M_Admin->getKonfirmasiPembayaran()->result();
        $data['title'] = 'Konfirmasi Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/konfirmasi_pembayaran',$data);
        $this->load->view('templates/footer');
    }
    public function verifikasiPembayaran($id)
    {
        $update = $this->M_Admin->updatePembayaran($id);
        $this->session->set_flashdata('pesan','Verifikasi telah Berhasil');
        if($update) {
            redirect('admin/konfirmasiPembayaran');
        }
    }
}