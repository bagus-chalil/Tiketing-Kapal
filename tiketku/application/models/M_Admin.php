<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model {
    
    public function getDataPelabuhan()
    {
        return $this->db->get('pelabuhan');
    }
    public function tambah_pelabuhan($nama)
    {
        $data = array('nama_pelabuhan' => $nama);
        return $this->db->insert('pelabuhan', $data);
    }
    public function delete_pelabuhan($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('pelabuhan');
    }
    public function tambah_jadwal($data)
    {
        return $this->db->insert('jadwal', $data);
    }
    public function getJadwal()
    {
		$this->db->select('jadwal.*, Asal.nama_pelabuhan AS ASAL, Tujuan.nama_pelabuhan As TUJUAN');
		$this->db->from('jadwal');
		$this->db->join('pelabuhan as Asal','jadwal.asal = Asal.id', 'left');
		$this->db->join('pelabuhan as Tujuan','jadwal.tujuan = Tujuan.id', 'left');
		return $this->db->get();
    }
    public function delete_jadwal($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('jadwal');
    }
    public function getDataEditJadwal($id)
    {
        $data = array(
            'jadwal.id' => $id, 
        );
        $this->db->select('jadwal.*, Asal.nama_pelabuhan AS ASAL, Tujuan.nama_pelabuhan As TUJUAN');
        $this->db->from('jadwal');
        $this->db->where($data);
		$this->db->join('pelabuhan as Asal','jadwal.asal = Asal.id', 'left');
		$this->db->join('pelabuhan as Tujuan','jadwal.tujuan = Tujuan.id', 'left');
        return $this->db->get();
    }
    public function ubah_jadwal($data)
    {
        $this->db->where('id',$this->input->post('id'));
        return $this->db->update('jadwal',$data);
    }
    public function getKonfirmasiPembayaran()
    {
        $where = array (
            'status' =>1
        );
        return $this->db->get_where('pembayaran', $where);
    }
    public function updatePembayaran($id)
    {
        $data = array (
            'status' =>2
        );
        $this->db->where('id', $id);  
        return $this->db->update('pembayaran', $data);
    }
}
?>