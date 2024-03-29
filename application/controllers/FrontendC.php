<?php

class FrontendC extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Mymod');

		$this->data['kat'] = $this->Mymod->ViewData('kategori');
		$this->data['best'] = $this->Mymod->best_seller()->result_array();

	}

	public function index()
	{

		$prod = $this->Mymod->ViewData('produk');
		$slide = $this->Mymod->ViewData('slider');
	//	$promo = $this->Mymod->ViewData('promo');
		$tgl=date('Y-m-d H:i:s');

		$jtable=[
			'promo' => 'produk_kode',
			'produk' => 'produk_kode'
		];
		$where=[
			't1.promo_start <='=>$tgl,
			't1.promo_end >'=>$tgl,
		];

		$xx['produk'] = $prod;
		$x['kategori'] = $this->data['kat'];
		$y['kategori'] = $this->data['kat'];
		$x['slider'] = $slide;
		$x['best'] = $this->data['best'];
		$y['title']='ORM FLORIST';


		$access_token = "2709387629.1677ed0.94730093b6734dfd9ceb9bbca2b6cf79";
		$photo_count = 6;
		$json_link = "https://api.instagram.com/v1/users/self/media/recent/?";
		$json_link .="access_token={$access_token}&count={$photo_count}";
		$json = file_get_contents($json_link);
		$obj = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $json), true);

		$x['ig'] =  $obj['data'];

	//	print_r($obj['data']);
	//	exit();
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/slider/slider');
		$this->load->view('frontend/index',$x);
		$this->load->view('frontend/layout/footer',$xx);

	}

	public function pembayaran(){
		$y['title']='Pembayaran';
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/form/pembayaran');
		$this->load->view('frontend/layout/footer');
	}

	public function cart()
	{
		if(isset($_SESSION['logged_in_user'])){
			$ses_user=$_SESSION['user_id'];
			$join='user';
			$where=[
				't1.user_id'=>$ses_user,
			];

			$jtable=[
				'keranjang' => 'produk_kode',
				'produk' => 'produk_kode'
			];
			$getcart = $this->Mymod->GetDataJoin($jtable,$where);

			$x['getCartData']=$getcart->result_array();
			$y['title']='Cart';
			$this->load->view('frontend/layout/header',$y);
			$this->load->view('frontend/myaccount/cart',$x);
			$this->load->view('frontend/layout/footer');
		} else {
			redirect('Login');
		}
	}

	public function invoice()
	{
		$segment=$this->uri->segment(3);

		$where=[
			't1.pemesanan_kode'=>$segment,
		];

		$jtable=[
			'pemesanan' => 'pemesanan_kode',
			'pemesanan_detailp' => 'pemesanan_kode',
			'pemesanan_ship' => 'pemesanan_kode',
			'pembayaran' => 'pemesanan_kode',
		];


		$data = $this->Mymod->GetDataJoinArr($jtable,$where);
		$y['title']='Invoice';
		$x['data'] = $data->row_array();
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/myaccount/invoice',$x);
		$this->load->view('frontend/layout/footer');
	}



	public function checkout()
	{
		if(isset($_SESSION['logged_in_user'])){
			$ses_user=$_SESSION['user_id'];
			$join='user';
			$where=[
				't1.user_id'=>$ses_user,
			];

			$jtable=[
				'keranjang' => 'produk_kode',
				'produk' => 'produk_kode'
			];
			$getcart = $this->Mymod->GetDataJoin($jtable,$where);
			$getRekening = $this->Mymod->ViewData('rekening');

			$whreuser=[
				'user_id'=>$_SESSION['user_id'],
			];
			$getUser = $this->Mymod->CekDataRows('user',$whreuser);

			$x['getCartData']=$getcart->result_array();
			$x['rekening']=$getRekening;
			$x['user']=$getUser->row_array();

			$y['title']='Cart';
			$this->load->view('frontend/layout/header',$y);
			$this->load->view('frontend/myaccount/checkout',$x);
			$this->load->view('frontend/layout/footer');
		} else {
			redirect('Login');			
		}
	}

	public function produk_detail()
	{

		$kode=$this->uri->segment(3);
		$table='produk';
		$where='produk_kode';
		$data=$kode;
		$prod = $this->Mymod->ViewDetail($table,$where,$data);
		$proed = $this->Mymod->ViewData('produk');
		$x['prd_detail'] = $prod;
		$xx['produk'] = $proed;
		$y['title']='Produk';
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/produk/produk_detail',$x);
		$this->load->view('frontend/layout/footer',$xx);
	}
	public function subkat()
	{
		$kode=$this->uri->segment(3);
		$table='produk';
		$where='produk_kode';
		$data=$kode;
		$nprds = $this->Mymod->joinsubkat($kode)->result_array();
		$proed = $this->Mymod->ViewData('produk');
		$x['nprd'] = $nprds;
		$xx['produk'] = $proed;
		$y['title']=$nprds[0]['sk_nama'];
		$y['kategori'] = $this->data['kat'];
		$x['best'] = $this->data['best'];
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/produk/subkat',$x);
		$this->load->view('frontend/layout/footer',$xx);
	}
	public function bykat()
	{

		$kode=$this->uri->segment(3);

		$table='produk';
		$where='produk_kode';
		$data=$kode;
		$nprds = $this->Mymod->joinkat($kode)->result_array();
		$proed = $this->Mymod->ViewData('produk');
		$x['nprd'] = $nprds;
		$x['best'] = $this->data['best'];
		$xx['produk'] = $proed;
		$y['kategori'] = $this->data['kat'];
		$y['title']=$nprds[0]['kategori_nama'];
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/produk/kat',$x);
		$this->load->view('frontend/layout/footer',$xx);
	}

	public function list()
	{

		$kode=$this->uri->segment(3);

		$table='produk';
		$where='produk_kode';
		$data=$kode;
		$best = $this->Mymod->best_seller()->result_array();
		$nprds = $this->Mymod->joinlist($kode)->result_array();
		$proed = $this->Mymod->ViewData('produk');
		$x['nprd'] = $nprds;
		$x['best'] = $best;
		$xx['produk'] = $proed;
		$y['title']='Produk';
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/produk/list',$x);
		$this->load->view('frontend/layout/footer',$xx);
	}


	public function register(){
		$y['title']='Register';
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/form/register');
		$this->load->view('frontend/layout/footer');
	}

	public function login(){
		$y['title']='Login';
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/form/login');
		$this->load->view('frontend/layout/footer');
	}


	public function produk(){
		$prod = $this->Mymod->ViewData('produk');
		$best = $this->Mymod->best_seller()->result_array();
		$y['kategori'] = $this->data['kat'];
		$x['produk'] = $prod;
		$x['best'] = $best;
		$x['kategori'] = $this->data['kat'];
		$xx['produk'] = $prod;
		$y['title']='Produk';
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/produk/produk',$x);
		$this->load->view('frontend/layout/footer',$xx);	
	}

	public function contactus(){
		$y['kategori'] = $this->data['kat'];
		$y['title']='Contact Us';
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/contact/contactus');
		$this->load->view('frontend/layout/footer');		
	}

	public function aboutus(){
		$y['kategori'] = $this->data['kat'];
		$y['title']='Contact Us';
		$this->load->view('frontend/layout/header',$y);
		$this->load->view('frontend/contact/aboutus');
		$this->load->view('frontend/layout/footer');		
	}

	public function myaccount(){
		$y['title']='My Account';
		if(isset($_SESSION['logged_in_user'])){
			$data=$_SESSION['user_id'];
			$table='user';
			$where='user_id';
			$user = $this->Mymod->ViewDetail($table,$where,$data);
			$x['user'] = $user;


			$bbtabel=[
				'pemesanan' => 'pemesanan_kode',
				'pembayaran' => 'pemesanan_kode'
			];
			$wpesan=[
				't1.user_id '=>$data,
				't2.pembayaran_status'=>'belumbayar',
				't2.pembayaran_method'=>'transfer',
			];

			$bdikirim=[
				't1.user_id '=>$data,
				't1.pemesanan_status'=>'waiting',
			];
			$pselesai=[
				't1.user_id '=>$data,
				't1.pemesanan_status'=>'selesai',
			];

			$y['kategori'] = $this->data['kat'];
			$x['selesai'] = $this->Mymod->GetDataJoin($bbtabel,$pselesai);
			$x['belumbayar'] = $this->Mymod->GetDataJoin($bbtabel,$wpesan);
			$x['belumdikirim'] =  $this->Mymod->GetDataJoin($bbtabel,$bdikirim);


			$this->load->view('frontend/layout/header',$y);
			$this->load->view('frontend/myaccount/myaccount',$x);
			$this->load->view('frontend/layout/footer');	
		} else {
			redirect('Login');
		}
	}
	public function myprofil(){
		$y['title']='My Accoyunt';
		if(isset($_SESSION['logged_in_user'])){
			$data=$_SESSION['user_id'];
			$table='user';
			$where='user_id';
			$user = $this->Mymod->ViewDetail($table,$where,$data);
			$x['user'] = $user;
			$this->load->view('frontend/layout/header',$y);
			$this->load->view('frontend/myaccount/myprofil',$x);
			$this->load->view('frontend/layout/footer');	
		}
	}

	public function addtocart(){

		$produk_kode=$this->input->post('produk_kode');
		$qty=$this->input->post('qty');
		$user_id=$_SESSION['user_id'];


		$title='Keranjang';
		$table='keranjang';

		$where=[
			'produk_kode'=>$produk_kode,
			'user_id'=>$user_id,
		];

		$cekproduk=$this->Mymod->CekDataRows($table,$where);
		if($cekproduk->num_rows()>0){
			$getprod=$cekproduk->row_array();
			$keranjang_id=$getprod['keranjang_id'];
			$keranjang_qty=$getprod['keranjang_qty'];

			$where=[
				'keranjang_id'=>$keranjang_id
			];

			$newqty=$qty+$keranjang_qty;
			$data=array(
				'keranjang_qty'=>$newqty,
			);
			$rd=$this->Mymod->UpdateData($table, $data, $where);
			$this->session->set_flashdata('cartsuccess', 'Berhasil merubah '.$title);
			redirect($_SERVER['HTTP_REFERER']);	


		}else {
			$data=array(
				'produk_kode'=>$produk_kode,
				'user_id'=>$user_id,
				'keranjang_qty'=>$qty,
			);
			$rd=$this->Mymod->InsertData($table,$data);
			$this->session->set_flashdata('cartsuccess', 'Berhasil menambah '.$title);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function delete_cart(){
		$keranjang_id=$this->input->post('keranjang_id');
		$title = 'Keranjang';
		$table='keranjang';
		$where = array(
			'keranjang_id' => $keranjang_id
		);

		$this->Mymod->DeleteData($table,$where);
		$this->session->set_flashdata('success', 'Berhasil menghapus data '.$title);
		header("Location: {$_SERVER['HTTP_REFERER']}");
		exit;
	}

	public function batal_pemesanan(){
		$pemesanan_kode=$this->input->post('pemesanan_kode');
		$title = 'Pemesanan';
		$table='pemesanan';
		$where =[ 
			'pemesanan_kode' => $pemesanan_kode
		];

		$this->Mymod->DeleteData($table,$where);
		$this->session->set_flashdata('success', 'Berhasil menghapus data '.$title);
		header("Location: {$_SERVER['HTTP_REFERER']}");
		exit;	
	}

	public function update_cart(){
		$qty = $this->input->post('qty');
		$produk_kode = $this->input->post('produk_kode');
		for($count = 0; $count < count($produk_kode); $count++){

			$data=[
				'keranjang_qty'=>$qty[$count],
			];

			$where=[
				'produk_kode'=>$produk_kode[$count],
			];
			$rd=$this->Mymod->UpdateData('keranjang', $data, $where);
		}
		$this->session->set_flashdata('success', 'Berhasil merubah data keranjang');
		redirect('cart');			

	}

	public function save_checkout(){
		$pemesanan_ongkir=$this->input->post('pemesanan_ongkir');
		$pemesanan_total=$this->input->post('pemesanan_total');
		$pemesanan_subtotal=$this->input->post('pemesanan_subtotal');
		$rekening=$this->input->post('rekening');
		$user_id=$this->input->post('user_id');
		$cid=$this->input->post('cid');
		$ps_nama=$this->input->post('ps_nama');
		$ps_email=$this->input->post('ps_email');
		$ps_tel=$this->input->post('ps_tel');
		$ps_alamat=$this->input->post('ps_alamat');
		$user_nama=$this->input->post('user_nama');
		$user_email=$this->input->post('user_email');
		$user_tel=$this->input->post('user_tel');
		$user_alamat=$this->input->post('user_alamat');
		$produk_kode=$this->input->post('produk_kode');
		$prd_kd=$this->input->post('prd_kd');
		$pdp_qty=$this->input->post('pdp_qty');
		$pdp_bonus=$this->input->post('pdp_bonus');
		$pdp_harga=$this->input->post('pdp_harga');
		$pdp_diskon=$this->input->post('pdp_diskon');
		$pdp_subtotal=$this->input->post('pdp_subtotal');
		$pemesanan_kode=$this->input->post('pemesanan_kode');
		$pembayaran_method=$this->input->post('pembayaran_method');
		$infoakun=$this->input->post('infoakun');



		$data=[
			'pemesanan_kode'=>$pemesanan_kode,
			'user_id'=>$user_id,
			'pemesanan_subtotal'=>$pemesanan_subtotal,
			'pemesanan_ongkir'=>$pemesanan_ongkir,
			'pemesanan_total'=>$pemesanan_total,
		];


		$rd=$this->Mymod->insertData('pemesanan',$data);

		if($rd){
			if($pembayaran_method=='ditempat'){
				$data_pembayaran=[
					'pemesanan_kode'=>$pemesanan_kode,
					'pembayaran_method'=>$pembayaran_method,
				];
			}else {
				$data_pembayaran=[
					'pemesanan_kode'=>$pemesanan_kode,
					'pembayaran_method'=>$pembayaran_method,
					'pembayaran_status'=>'belumbayar',
				];
			}

			$rs=$this->Mymod->insertData('pembayaran',$data_pembayaran);

			if($rs){
				for($count = 0; $count < ($cid); $count++){
					$detailp=[
						'pemesanan_kode'=>$pemesanan_kode,
						'produk_kode'=>$produk_kode[$count],
						'pdp_qty'=>$pdp_qty[$count],
						'pdp_bonus'=>$pdp_bonus[$count],
						'pdp_harga'=>$pdp_harga[$count],
						'pdp_diskon'=>$pdp_diskon[$count],
						'pdp_subtotal'=>$pdp_subtotal[$count],
					];
					$this->Mymod->insertData('pemesanan_detailp',$detailp);

				}

				if($infoakun=='sesuai'){
					$ship=[
						'pemesanan_kode'=>$pemesanan_kode,
						'ps_nama'=>$user_nama,
						'ps_email'=>$user_email,
						'ps_tel'=>$user_tel,
						'ps_alamat'=>$user_alamat,
					];
				}else {
					$ship=[
						'pemesanan_kode'=>$pemesanan_kode,
						'ps_nama'=>$ps_nama,
						'ps_email'=>$ps_email,
						'ps_tel'=>$ps_tel,
						'ps_alamat'=>$ps_alamat,
					];	
				}


				$this->Mymod->insertData('pemesanan_ship',$ship);

				$table='keranjang';
				$user_id=$_SESSION['user_id'];
				$where = [
					'user_id' => $user_id
				];
				$this->Mymod->DeleteData($table,$where);
				$this->session->set_flashdata('success', 'Berhasil memesan');
				redirect('checkout');
			}
			else {
				$this->session->set_flashdata('success', 'Gagal memesan');
				redirect('checkout');
			}
		} else {
			$this->session->set_flashdata('success', 'Gagal memesan');
			redirect('checkout');
		}


	}


	public function update_user(){

		$user_nama=$this->input->post('user_nama');
		$user_email=$this->input->post('user_email');
		$user_tel=$this->input->post('user_tel');
		$user_alamat=$this->input->post('user_alamat');
		$user_id=$_SESSION['user_id'];

		$title='User';
		$table='user';

		$where=[
			'user_id'=>$user_id
		];

		$data=[
			'user_nama'=>$user_nama,
			'user_email'=>$user_email,
			'user_tel'=>$user_tel,
			'user_alamat'=>$user_alamat
		];
		$rd=$this->Mymod->UpdateData($table, $data, $where);
		if($rd){
			$this->session->set_flashdata('success', 'Berhasil merubah '.$title);
			redirect('myaccount');			
		}	else {
			$this->session->set_flashdata('error', 'Gagal merubah '.$title);
			redirect('myaccount');			
		}
	}
	public function update_password(){

		$password=$this->input->post('password');
		$repassword=$this->input->post('repassword');
		$user_id=$_SESSION['user_id'];

		$title='Password';
		$table='user';

		if ($password==$repassword) {

			$where=[
				'user_id'=>$user_id
			];

			$data=[
				'user_password'=>md5($password),
			];
			$rd=$this->Mymod->UpdateData($table, $data, $where);
			if($rd){
				$this->session->set_flashdata('success', 'Berhasil merubah '.$title);
				redirect('myaccount');			
			}	else {
				$this->session->set_flashdata('error', 'Gagal merubah '.$title);
				redirect('myaccount');			
			}
		} else {

			$this->session->set_flashdata('error', 'Gagal merubah '.$title);
			redirect('myaccount');			
		}


	}


	function upbukti(){
		$pembayaran_nama=$this->input->post('pembayaran_nama');
		$pemesanan_kode=$this->input->post('pemesanan_kode');

		$cekinvoice=$this->Mymod->CekDataRows('pemesanan',['pemesanan_kode' => $pemesanan_kode])->num_rows();
		if($cekinvoice == 0) {
			$this->session->set_flashdata('error', 'Kode Invoice yang anda masukan salah atau tidak terdaftar, silahkan ulangi lagi');
			redirect('upload/pembayaran');		
		} else {

			$table='pembayaran';

			$where = [
				'pemesanan_kode' => $pemesanan_kode
			];

			if(!empty($_FILES['filefoto']['name'])){
				$config['upload_path'] = 'assets\images\transfer';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['filefoto']['name'];
				$config['width'] = 1920;
				$config['height'] = 683;

				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('filefoto')){
					$uploadData = $this->upload->data();
					$pembayaran_bukti = $uploadData['file_name'];

					$data = [
						'pembayaran_nama' => $pembayaran_nama,
						'pembayaran_bukti' => $pembayaran_bukti,
						'pembayaran_status' => 'pending',
					];
					$UpdateData=$this->Mymod->UpdateData($table,$data,$where);
					if($UpdateData){
						$this->session->set_flashdata('success', 'Berhasil mengirim data '.$title);
						redirect('upload/pembayaran');		
					}else{
						$this->session->set_flashdata('error', 'Gagal ngeirim data '.$title);
						redirect('upload/pembayaran');		
					}
				}else{
					$this->session->set_flashdata('error', 'Gagal ngeirim data '.$title);
					redirect('upload/pembayaran');		
				}
			}else{
				$this->session->set_flashdata('error', 'Gagal ngeirim data '.$title);
				redirect('upload/pembayaran');		
			}
		}
	}
}