<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keranjang_model extends CI_Model {

	public function get_produk_all()
	{
		$query = $this->db->select('*');
		$query = $this->db->from('tbl_produk');
		//$query = $this->db->where('stok > 0');
		$query = $this->db->where('aktif','Y');	
		$query = $this->db->order_by("id_produk","desc");	
		//$query = $this->db->get('tbl_produk');
		$query = $this->db->get();
		return $query->result_array();
	}

		public function get_produk_all_stok()
	{
		$query = $this->db->select('*');
		$query = $this->db->from('tbl_produk');
		$query = $this->db->where('stok > 0');
		$query = $this->db->where('aktif','Y');	
		$query = $this->db->order_by("id_produk","desc");	
		//$query = $this->db->get('tbl_produk');
		$query = $this->db->get();
		return $query->result_array();
	}


	function manualQuery($q)
    {
        $res = $this->db->query($q);        
        return $data = $res->result_array();
    }
	
	public function get_produk_kategori($kategori)
	{
		if($kategori>0)
			{
				$this->db->where('kategori',$kategori);
			}
		$query = $this->db->select('*');
		$query = $this->db->from('tbl_produk');
		//$query = $this->db->where('stok > 0');
		$query = $this->db->where('aktif','Y');	
		//$query = $this->db->get('tbl_produk');
		$query = $this->db->get();
		return $query->result_array();
	}

		public function get_produk_kategori_stok($kategori)
	{
		if($kategori>0)
			{
				$this->db->where('kategori',$kategori);
			}
		$query = $this->db->select('*');
		$query = $this->db->from('tbl_produk');
		$query = $this->db->where('stok > 0');
		$query = $this->db->where('aktif','Y');	
		//$query = $this->db->get('tbl_produk');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function rupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
 
}
	
	public function get_kategori_all()
	{
		$query = $this->db->get('tbl_kategori');
		return $query->result_array();
	}
	
	public  function get_produk_id($id)
	{
		$this->db->select('tbl_produk.*,nama_kategori');
		$this->db->from('tbl_produk');
		$this->db->join('tbl_kategori', 'kategori=tbl_kategori.id','left');
   		$this->db->where('id_produk',$id);
        return $this->db->get();
    }	
	
	public function tambah_pelanggan($data)
	{
		$this->db->insert('tbl_pelanggan', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function tambah_order($data)
	{
		$this->db->insert('tbl_order', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function tambah_detail_order($data)
	{
		$this->db->insert('tbl_detail_order', $data);
	}

	public function cek_user($data) {
    $query = $this->db->get_where('tb_karyawan', $data);
    return $query;
    }

 public function getSelectedData($table,$data)
    {
        $res = $this->db->get_where($table, $data); 
        return $data = $res->result_array();
    }

     public function updateData($table,$data,$field_key)
    {
        $data = $this->db->update($table,$data,$field_key);
        return $data;
    }

public function GetTotalsetor($nik)
{
    $q = $this->db->query("SELECT sum(setor) as tot_setor from tb_deposit_detil where nik ='".$nik."'");
    return $data = $q->result_array();
}

public function GetTotaltarik($nik)
{
    $q = $this->db->query("SELECT sum(tarik) as tot_tarik from tb_deposit_detil where nik ='".$nik."'");
    return $data = $q->result_array();
}

public function GetTotalOrder($nik)
{
    $q = $this->db->query("SELECT sum(total_order) as tot_order from tbl_order where status = 'order' and nik ='".$nik."'");
    return $data = $q->result_array();
}

public function saldoOrder($nik){
	$q = $this->db->query("SELECT (b.qty*b.harga) as tot_harga FROM tbl_order a,tbl_detail_order b WHERE b.order_id=a.id and a.nik='".$nik."' and b.terima='N'");
	return $data = $q->result_array();
}

public  function get_order_ready()
	{
       $q = $this->db->query("SELECT b.nama FROM tb_karyawan b, tbl_order u WHERE u.nik = b.nik and u.status = 'ready' GROUP BY b.nama");
    return $data = $q->result_array();
    }

}
?>