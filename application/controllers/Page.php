<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	public function __construct()
	{	
		parent::__construct();
    $this->load->helper(array('url','download')); 
		$this->load->library('cart');
		$this->load->model('keranjang_model');
	}

	public function logout()
    {
    $this->cart->destroy();
    session_destroy();
    echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
    }
	public function index()
		{
			$data['produk'] = $this->keranjang_model->get_produk_all();
			$data['kategori'] = $this->keranjang_model->get_kategori_all();
      $data['nama'] = $this->keranjang_model->get_order_ready();
			$this->load->view('themes/header',$data);
			$this->load->view('shopping/list_produk',$data);
			$this->load->view('themes/footer');
		}

    public function index1()
    {
      $data['produk'] = $this->keranjang_model->get_produk_all_stok();
      $data['kategori'] = $this->keranjang_model->get_kategori_all();
      $data['nama'] = $this->keranjang_model->get_order_ready();
      $this->load->view('themes/header',$data);
      $this->load->view('shopping/list_produk',$data);
      $this->load->view('themes/footer');
    }
    
	public function tentang()
		{
			$data['kategori'] = $this->keranjang_model->get_kategori_all();
			$this->load->view('themes/header',$data);
			$this->load->view('pages/tentang',$data);
			$this->load->view('themes/footer');
		}	
	public function cara_bayar()
		{
			$data['kategori'] = $this->keranjang_model->get_kategori_all();
			$this->load->view('themes/header',$data);
			$this->load->view('pages/cara_bayar',$data);
			$this->load->view('themes/footer');
		}	

	public function login()
		{
			$data['kategori'] = $this->keranjang_model->get_kategori_all();
			$this->load->view('themes/header',$data);
			$this->load->view('login');
			$this->load->view('themes/footer');
		}	

	public function gantipassword()
		{
			$data['kategori'] = $this->keranjang_model->get_kategori_all();
			$this->load->view('themes/header',$data);
			$this->load->view('gantipassword');
			$this->load->view('themes/footer');
		}

  public function cek_order(){
    $data1['kategori'] = $this->keranjang_model->get_kategori_all();
    $data['order']= $this->keranjang_model->manualQuery("SELECT a.id,a.tanggal,a.jam,a.nik,a.total_order,b.nama,a.status FROM tbl_order a, tb_karyawan b WHERE a.nik=b.nik and a.status = 'ready' order by a.id desc");
    $this->load->view('themes/header',$data1);
      $this->load->view('pages/tampil_order',$data);
      $this->load->view('themes/footer');

  }

	    public function validate() {

        $data = array('nik' => $this->input->post('nik', TRUE),
                        'password' => md5($this->input->post('password', TRUE))
            );

      //  $this->load->model('main_model'); // load model_user
        $hasil = $this->keranjang_model->cek_user($data);
        
        
        if ($hasil->num_rows() == 1) {



            foreach ($hasil->result() as $sess) {
                $sess_data['logged_in'] = 'Sudah Loggin';
              //  $sess_data['uid'] = $sess->uid;
                $sess_data['nik'] = $sess->nik;
                //$sess_data['level'] = $sess->level;
                $sess_data['nama'] = $sess->nama;
                $sess_data['departemen'] = $sess->departemen;
                //$sess_data['email'] = $sess->email;
                $this->session->set_userdata($sess_data);
            }
            
         redirect('shopping/index');
                   
        }
        else {
            echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
        }
       
    }	

    public function cek_saldo()
    {
    if($this->session->userdata('nik')=="")
      {
      ?><script type="text/javascript" language="javascript">
          alert("Silahkan Login terlebih dahulu untuk cek saldo !!!");
        </script>
        <?php
          echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/page/login'>";
      }else{

      	$datanik['nik'] = $this->session->userdata('nik');
  		$row= $this->keranjang_model->getSelectedData('tb_karyawan',$datanik);
 		 if($row)
  		{
     	    $data_nik = $row[0]['nik'];
   		 // ambil total nilai storan
    		$i = $this->keranjang_model->GetTotalSetor($data_nik);
    		if($i){$total_setor = $i[0]['tot_setor'];}
    		else{$total_setor = '0';}
    
    //ambil total nilai penarikan
    		 $j = $this->keranjang_model->GetTotaltarik($data_nik);
    		if($j){$total_tarik = $j[0]['tot_tarik'];}
    		else{$total_tarik = '0';}

        //ambil total nilai order terakhir
       //  $k = $this->keranjang_model->GetTotalOrder($data_nik);
        //if($k){$total_order = $k[0]['tot_order'];}
        //else{$total_order = '0';}

         $k = $this->keranjang_model->saldoOrder($data_nik);
        $total_order= 0;
        if($k){
          foreach ($k as $j ) {
          $total_order = $total_order + $j['tot_harga'];
            }
          }
        else{$total_order = '0';}
   
   
   //saldo akhir total setor di kurangi total penarikan
    		$saldo = $total_setor - $total_tarik - $total_order;
    		$rpsaldo = $this->keranjang_model->rupiah($saldo);
    		$data = array('nik' => $row[0]['nik'],
    		'nama' => $row[0]['nama'],
    		'departemen' => $row[0]['departemen'],
   		 	'saldo' => $rpsaldo);
			$data1['kategori'] = $this->keranjang_model->get_kategori_all();
			$this->load->view('themes/header',$data1);
			$this->load->view('saldo',$data);
			$this->load->view('themes/footer');
		}
		}
    }

 public function history()
    {
    if($this->session->userdata('nik')=="")
      {
      ?><script type="text/javascript" language="javascript">
          alert("Session anda sudah habis....Silahkan Login kembali !!!");
        </script>
        <?php
          echo "<meta http-equiv='refresh' content='0; url=".base_url()."page/login'>";
      }else{

        $datanik['nik'] = $this->session->userdata('nik');
      $row= $this->keranjang_model->getSelectedData('tb_karyawan',$datanik);
     if($row)
      {
          $data_nik = $row[0]['nik'];
       // ambil total nilai storan
    
       // $rpsaldo = $this->keranjang_model->rupiah($saldo);
        $data = array('nik' => $row[0]['nik'],
        'nama' => $row[0]['nama'],
        'departemen' => $row[0]['departemen'],
        'order'=> $this->keranjang_model->manualQuery("SELECT * from tbl_order where nik ='".$data_nik."' order by tanggal DESC LIMIT 10"));
      $data1['kategori'] = $this->keranjang_model->get_kategori_all();
      $this->load->view('themes/header',$data1);
      $this->load->view('history',$data);
      $this->load->view('themes/footer');
    }
    }
    }

    public function detil_order($id){

    if($this->session->userdata('nik')=="")
      {
      ?><script type="text/javascript" language="javascript">
          alert("Session anda sudah habis..Silahkan Login kembali !!!");
        </script>
        <?php
          echo "<meta http-equiv='refresh' content='0; url=".base_url()."page/login'>";
      }else{

        $data['id']= $id;
        $row = $this->keranjang_model->getSelectedData('tbl_order',$data);
        if($row)
        {
          $id_order = $row[0]['id'];
          $nik['nik'] = $row[0]['nik'];
          $r = $this->keranjang_model->getSelectedData('tb_karyawan',$nik);
        $data = array('action'=> site_url('order/do_posting'),
        'nik'=> $row[0]['nik'],
        'id'=> $row[0]['id'],
        'status'=> $row[0]['status'],
        'nama'=> $r[0]['nama'],
        'departemen'=> $r[0]['departemen'],
        'tanggal'=> $row[0]['tanggal'],
        'jam'=> $row[0]['jam'],
        'detil_order'=> $this->keranjang_model->manualQuery("SELECT a.id, a.order_id, a.harga, (a.harga * a.qty) as total_harga ,
          a.qty,b.nama_produk,a.posting 
          FROM tbl_detail_order a,tbl_produk b 
          WHERE a.produk=b.id_produk 
          and order_id='".$id_order."'"));

      $data1['kategori'] = $this->keranjang_model->get_kategori_all();
      $this->load->view('themes/header',$data1);
      $this->load->view('history_detil',$data);
      $this->load->view('themes/footer');

        }
        else
          echo "Data Tidak ditemukan";
      }
    }


    public function do_password()
    {
    $pass = $_POST['password'];
    $pass1 = $_POST['password1'];
    $nik= $this->session->userdata('nik');
    if($pass=='')
    {
      $this->session->set_flashdata('berhasil',' <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Password tidak ada di ganti!</strong>
      </div>');
      redirect('page/gantipassword');

    } else{ 
    if($pass==$pass1)
    {
      $passbaru= md5($pass);
      $data_masuk = array(
      'password'=> $passbaru);
      $where = array ('nik'=>$nik);
      $res = $this->keranjang_model->updateData('tb_karyawan',$data_masuk,$where);
      if ($res >= 1) {
      $this->session->set_flashdata('berhasil',' <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Update Sukses!</strong> Password baru sudah di ganti...
      </div>');
      redirect('page/login');
      }
      else
      {
      $this->session->set_flashdata('berhasil',' <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Error!</strong> Gagal Insert nih...
      </div>');
      redirect('page/gantipassword');
      }
    }
    else{
       $this->session->set_flashdata('berhasil',' <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Error!</strong> Password baru tidak sama..
      </div>');
      redirect('page/gantipassword');

    }
  }
    }	

      public function download()
    {
      $data['kategori'] = $this->keranjang_model->get_kategori_all();
      $this->load->view('themes/header',$data);
      $this->load->view('pages/download',$data);
      $this->load->view('themes/footer');
    } 
  public function do_download(){       
    force_download('files/form_anggota.pdf',NULL);
  } 
}
