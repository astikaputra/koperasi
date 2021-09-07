<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shopping extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('keranjang_model');
	}

	public function index()
	{
		$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
		$data['produk'] = $this->keranjang_model->get_produk_kategori($kategori);
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('themes/header',$data);
		$this->load->view('shopping/list_produk',$data);
		$this->load->view('themes/footer');
	}
	
	public function index1()
	{
		$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
		$data['produk'] = $this->keranjang_model->get_produk_kategori_stok($kategori);
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('themes/header',$data);
		$this->load->view('shopping/list_produk',$data);
		$this->load->view('themes/footer');
	}
	public function tampil_cart()
	{
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('themes/header',$data);
		$this->load->view('shopping/tampil_cart',$data);
		$this->load->view('themes/footer');
	}
	
	public function check_out()
	{
		 $data_nik = $this->session->userdata('nik');
   		 // ambil total nilai storan
    		$i = $this->keranjang_model->GetTotalSetor($data_nik);
    		if($i){$total_setor = $i[0]['tot_setor'];}
    		else{$total_setor = '0';}
    
    //ambil total nilai penarikan
    		 $j = $this->keranjang_model->GetTotaltarik($data_nik);
    		if($j){$total_tarik = $j[0]['tot_tarik'];}
    		else{$total_tarik = '0';}

    		//ambil total nilai order terakhir
    		
    $k = $this->keranjang_model->saldoOrder($data_nik);
        $total_order= 0;
        if($k){
          foreach ($k as $j ) {
          $total_order = $total_order + $j['tot_harga'];
            }
          }
        else{$total_order = '0';}

   
   //saldo akhir total setor di kurangi total penarikan
    		$saldo1 = $total_setor - $total_tarik - $total_order;
    		$rpsaldo = $this->keranjang_model->rupiah($saldo1);
		
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$data['nik'] = $this->session->userdata('nik');
		$data['nama'] = $this->session->userdata('nama');
		$data['departemen'] = $this->session->userdata('departemen');
		$data['saldo'] = $rpsaldo; 
		$data['saldo1'] = $saldo1; 

		$this->load->view('themes/header',$data);
		$this->load->view('shopping/tampil_order',$data);
		$this->load->view('themes/footer');
	}
	
	public function detail_produk()
	{
		$id=($this->uri->segment(3))?$this->uri->segment(3):0;
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$data['detail'] = $this->keranjang_model->get_produk_id($id)->row_array();
		$this->load->view('themes/header',$data);
		$this->load->view('shopping/detail_produk',$data);
		$this->load->view('themes/footer');
	}
	
	
	function tambah()
	
	{	
	
	if($this->session->userdata('nik')=="")
      {
      ?>
      <script type="text/javascript" language="javascript">
          alert("Silahkan Login terlebih dahulu untuk melakukan order !!!");
      </script>
      <?php
          echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/page/login'>";
      }else{

		$data_produk= array('id' => $this->input->post('id'),
							 'name' => $this->input->post('nama'),
							 'price' => $this->input->post('harga'),
							 'gambar' => $this->input->post('gambar'),
							 'qty' =>$this->input->post('qty')
							);
		//print_r($data_produk);
		$this->cart->insert($data_produk);
		redirect('shopping');
	 }
	}

	function hapus($rowid) 
	{
		if ($rowid=="all")
			{
				$this->cart->destroy();
			}
		else
			{
				$data = array('rowid' => $rowid,
			  				  'qty' =>0);
				$this->cart->update($data);
			}
		redirect('shopping/tampil_cart');
	}

	function ubah_cart()
	{
		$cart_info = $_POST['cart'] ;
		foreach( $cart_info as $id => $cart)
		{
			$rowid = $cart['rowid'];
			$price = $cart['price'];
			$gambar = $cart['gambar'];
			$amount = $price * $cart['qty'];
			$qty = $cart['qty'];
			$data = array('rowid' => $rowid,
							'price' => $price,
							'gambar' => $gambar,
							'amount' => $amount,
							'qty' => $qty);
			$this->cart->update($data);
		}
		redirect('shopping/tampil_cart');
	}

	public function save_order()
	{
	if($this->session->userdata('nik')=="")
      {
      ?>
      <script type="text/javascript" language="javascript">
          alert("anda belum login atau session anda sudah habis!!!");
      </script>
      <?php
          echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/page/login'>";
      }else{
		//-------------------------Input data order--------------------------
		$data_order = array('nik' => $this->input->post('nik'),
							'tanggal' => date('Y-m-d'),
							'jam' => date('H:i:s'),
							'deposit' => $this->input->post('deposit'),
							'total_order' => $this->input->post('grantotal'),
							'status' => "order");
		
		$id_order = $this->keranjang_model->tambah_order($data_order);
		//-------------------------Input data detail order-----------------------		
		if ($cart = $this->cart->contents())
			{
				foreach ($cart as $item)
					{
						$data_detail = array('order_id' =>$id_order,
										'produk' => $item['id'],
										'qty' => $item['qty'],
										'harga' => $item['price']);			
						$proses = $this->keranjang_model->tambah_detail_order($data_detail);
					}
			}
		//-------------------------Hapus shopping cart--------------------------		
		$this->cart->destroy();
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('themes/header',$data);
		$this->load->view('shopping/sukses',$data);
		$this->load->view('themes/footer');
	}
  }
}
?>