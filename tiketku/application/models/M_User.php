<?php 
defined('BASEPATH') OR exit('No direct access allowed');

class M_User extends CI_Model {
 
    public function getDataPelabuhan()
    {
        return $this->db->get('pelabuhan');
    }
    public function cari_tiket($data){
		$this->db->select('jadwal.*, Asal.nama_pelabuhan AS ASAL, Tujuan.nama_pelabuhan As TUJUAN');
		$this->db->where($data);
		$this->db->like('tgl_berangkat', $this->input->post('tanggal'));
		$this->db->from('jadwal');
		$this->db->join('pelabuhan as Asal','jadwal.asal = Asal.id', 'left');
		$this->db->join('pelabuhan as Tujuan','jadwal.tujuan = Tujuan.id', 'left');
		return $this->db->get();
	}
    public function getDataInfoPesan($id)
    {
        $this->db->select('jadwal.*, Asal.nama_pelabuhan AS ASAL, Tujuan.nama_pelabuhan As TUJUAN');
        $this->db->where('jadwal.id',$id);
		$this->db->join('pelabuhan as Asal','jadwal.asal = Asal.id', 'left');
		$this->db->join('pelabuhan as Tujuan','jadwal.tujuan = Tujuan.id', 'left');
        return $this->db->get('jadwal');
    }
    public function getPembayaran()
    {
        return $this->db->get('pembayaran');
    }
    public function getTiket()
    {
        return $this->db->get('tiket');
    }
    public function insertPenumpang($data)
    {
        return $this->db->insert('penumpang',$data);
    }

    public function insertPemesan($data)
    {
        return $this->db->insert('tiket',$data);
    }
    public function insertPembayaran($data)
    {
        return $this->db->insert('pembayaran',$data);
    }
    public function getPembayaranWhere($kode)
    {
        $this->db->where('no_pembayaran',$kode);
        return $this->db->get('pembayaran');
    }
    public function cekKonfirmasi($nomor)
    {
        $this->db->where('nomor_tiket',$nomor);
        return $this->db->get('penumpang');
    }
    public function  insertBukti($nama,$no)
    {
        $data = array(
            'bukti' => $nama,
            'status' => 1
        );
        $this->db->where('no_pembayaran',$no);
        return $this->db->update('pembayaran',$data);
    }
    public function getPrint($no_tiket)
    {
        $this->db->select('*, Asal.nama_pelabuhan AS ASAL, Tujuan.nama_pelabuhan As TUJUAN'); 
        $this->db->join('jadwal','jadwal.id=tiket.id_jadwal'); 
        $this->db->join('pelabuhan as Asal','jadwal.asal = Asal.id', 'left');
        $this->db->join('pelabuhan as Tujuan','jadwal.tujuan = Tujuan.id', 'left');
        $this->db->where('nomor_tiket', $no_tiket); 
        
        return $this->db->get('tiket');

    }
   
}