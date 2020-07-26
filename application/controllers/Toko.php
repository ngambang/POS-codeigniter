<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		//tgl dari laporan
		if(empty($_SESSION['kategori'])){

			$_SESSION['kategori'] = 'null';

		}

		//tgl dari laporan
		if(empty($_SESSION['dari_laporan'])){

			$_SESSION['dari_laporan'] = date("Y-m")."-01";

		}

		//tgl sampai laporan
		if(empty($_SESSION['sampai_laporan'])){

			$_SESSION['sampai_laporan'] = date("Y-m-d");

		}

		if(empty($_SESSION['dari_stok'])){

			$_SESSION['dari_stok'] = date("Y-m")."-01";

		}

		if(empty($_SESSION['sampai_stok'])){

			$_SESSION['sampai_stok'] = date("Y-m-d");

		}


		//handle session
		if(!empty($this->uri->segment(2)) &&
			$this->uri->segment(2) !=='login'
		  ){

			if(empty($_SESSION['data-login'])){
	
				redirect();
	
			}

		}

 
		$this->load->model('mo_toko');
		$this->load->library('pagination');
 

	} 

	public function index(){
		
		if(isset($_SESSION['data-login'])){ // jika data login masih tersimpan

			redirect('home');

		}

		$data['nama_toko'] = $this->mo_toko->getAll('setting');

		//halaman login
		$this->load->view('login',$data);

	}

	public function login(){
		//echo "jhg";
		if(isset($_POST['email']) && isset($_POST['password'])){
			$arr = array();
			
			$arr['username'] = $this->input->post('email',true);
			$arr['password'] = md5($this->input->post('password',true));

			$cek_login = $this->mo_toko->getWhere('userlogin',$arr);
			
			//data yang dicari ditemukan
			if($cek_login['row'] > 0){

				$_SESSION['data-login'] = $cek_login['data'][0];
				redirect('home');
			
			}
				

		}

		//login salah/error
		redirect();

	}

	public function home(){
		
		$data['data1'] = 'hello';
		$this->template('home',$data);

	}

	public function produk(){

		$cari = null;

		if(isset($_GET['cari'])){

			$txt_dicari = '';
			$txt_cari   = explode(' ',$_GET['cari']);
			$no_cari = 0;
			foreach($txt_cari as $c){
				if($no_cari == 0){
					
					$txt_dicari .= " nama_produk like '%${c}%'";
					
				}else{
					
					$txt_dicari .= " and nama_produk like '%${c}%'";
				}
				
				$no_cari++;
			}

			$cari = $txt_dicari;
			
		}

		if(isset($_GET['kategori'])){
			
			$_SESSION['kategori'] = $_GET['kategori'];
			redirect("produk");
		}

		$page 					   = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
		$config['base_url']		   = base_url() . 'produk';
        $config['total_rows']	   = $this->mo_toko->produkPaging($cari);
        $config['per_page'] 	   = 20;
        $config["uri_segment"]     = 2;
        $config['num_links']       =  4;
        
        //custom paging
		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		// $data["rs"]				   = $this->mo_fastpos->paging_stok($config['per_page'] ,$page*$config['per_page'],$cari,$_SESSION['filter'],$csupp);
  
        $data['produk']				= $this->mo_toko->produkall($config["per_page"],$page,$cari);    

		$data['page'] 				= $this->pagination->create_links();
		$data['kategori'] 			= $this->mo_toko->getAll('kategori','id_kategori desc');
		$data['total_uang']			= $this->mo_toko->hitungDataProduk();
		// echo "<pre>";
		// print_r($data['total_uang']);
		$this->template('produk',$data);


	}

	public function simpan_kat(){
		
		$data   = file_get_contents('php://input');
		$data   = json_decode($data,true);

		$return = array( 'error' => 1 ); 

		$nama = @$data['nama'];
		
		if($nama){

			$arrInput 		 = array('nama_kategori' => $nama);
			$id_input  		 = $this->mo_toko->insert("kategori",$arrInput);
			
			$return['error'] = 0;
			$return['nama']  = $nama;
			$return['id']	 = $id_input;

		}

		echo json_encode($return);

	}

	public function hapus_kat(){

		$id = @$_GET['idHps'];

		$return = array('error' => 1);

		if($id){

			$this->mo_toko->hapus('kategori',array('id_kategori'=>$id));
			$return['error'] = 0;
		}

		echo json_encode($return);

	}

	public function tambah_produk(){

		if( isset($_POST['namaProduk']) &&
			isset($_POST['jmlStok'])&&
			isset($_POST['hrgBeli'])&&
			isset($_POST['hrgJual'])
		  ){


			$arrInput = array( 'nama_produk'  => $_POST['namaProduk'],
								'kode_barcode'=> $_POST['kodeBarcode'],
								'stok'		  => $_POST['jmlStok'],
								'kategori'	  => $_POST['kategori'],
								'harga_beli'  => $_POST['hrgBeli'],
								'catatan'  	  => $_POST['catatan'],
								'harga_jual'  => $_POST['hrgJual'],
								'tgl_buat'    => date('Y-m-d H:i:s'),
								'tgl_up'	  => date('Y-m-d H:i:s')
							   );
							   
	
				
			
			$id_pro   = $this->mo_toko->insert('data_produk',$arrInput);		
			
			$arrLog = array(
				'id_produk'	   => $id_pro,
				'stok_sesudah' => $_POST['jmlStok'],
				'stok_sebelum' => 0,
				'keterangan'   => "Penambahan Produk (Penambahan)",
				'opr'		   => $_SESSION['data-login']['username']
			   );

			$this->mo_toko->insert("log_stok",$arrLog);


		  }

		  redirect($_SERVER['HTTP_REFERER']);


	}

	public function edit_produk(){
		
		if( isset($_POST['namaProduk']) &&
			isset($_POST['jmlStok'])	&&
			isset($_POST['hrgBeli'])	&&
			isset($_POST['id'])			&&
			isset($_POST['hrgJual'])
		){

		$data = $this->mo_toko->getWhere('data_produk',array('id_produk'=>$_POST['id']));
		$stok_sebelum = isset($data['data'][0]['stok'])?$data['data'][0]['stok']:0;
		$status = 'Pengurangan';
		
		if($_POST['jmlStok'] > $stok_sebelum){
			$status = 'Penambahan';
		}

		$arrLog = array(
			'id_produk'	   => $_POST['id'],
			'stok_sesudah' => $_POST['jmlStok'],
			'stok_sebelum' => $stok_sebelum,
			'keterangan'   => "Edit Produk ({$status})",
			'opr'		   => $_SESSION['data-login']['username']
		   );

		if($_POST['jmlStok'] !== $stok_sebelum){

			$this->mo_toko->insert("log_stok",$arrLog);
		}

		$arrInput = array(  'nama_produk'  => $_POST['namaProduk'],
							'kode_barcode'=> $_POST['kodeBarcode'],
							'stok'		  => $_POST['jmlStok'],
							'kategori'	  => $_POST['kategori'],
							'harga_beli'  => $_POST['hrgBeli'],
							'catatan'  	  => $_POST['catatan'],
							'harga_jual'  => $_POST['hrgJual'],
							'tgl_buat'    => date('Y-m-d H:i:s'),
							'tgl_up'	  => date('Y-m-d H:i:s')
						   );
		
		$this->mo_toko->update('data_produk',$arrInput,array('id_produk'=>$_POST['id']));
		
		

	  }

	  redirect($_SERVER['HTTP_REFERER']);

	}

	public function detail_produk(){

		if(isset($_GET['id'])){

			$id = @$_GET['id'];

			$whereArr = array('id_produk' => $id);

			$rs	= $this->mo_toko->getWhere('data_produk',$whereArr);
			
			echo  json_encode($rs);

		}


	}

	public function hapus_produk(){

		$where = array('id_produk' => @$_GET['id']);
		$this->mo_toko->hapus('data_produk',$where);
		redirect($_SERVER['HTTP_REFERER']);
	}

	function cari_produk(){
		$cari = @$_GET['c'];
		$cari_arr = explode(" ",$cari);
		
		$keyCari = 0;
		$keyword = '';
		
		foreach($cari_arr as $c){

			if($keyCari ==  0){

				$keyword.= "nama_produk like '%{$c}%'";

			}else{


				$keyword.= " and nama_produk like '%{$c}%'";

			}
			
			$keyCari++;

		}

		$hasil = array();
		//hasil pencarian barang
		$produk = $this->mo_toko->getWhere('data_produk',null,$keyword,5);
		
		if($produk['row'] > 0 ){
			
			foreach ($produk['data'] as $key => $value) {
				
				$arrSementara = array();
				$arrSementara['value'] = $value['nama_produk'];
				$arrSementara['harga'] = $value['harga_jual'];
				$arrSementara['hpp']   = $value['harga_beli'];
				$arrSementara['id']	   = $value['id_produk'];
				$arrSementara['bc']	   = 0; 
				array_push($hasil,$arrSementara);

			}

		}else{

			$produk = $this->mo_toko->getWhere('data_produk',array('kode_barcode'=>$cari),null,5);

			foreach ($produk['data'] as $key => $value) {
				
				$arrSementara = array();
				$arrSementara['value'] = $value['nama_produk'];
				$arrSementara['harga'] = $value['harga_jual'];
				$arrSementara['id']	   = $value['id_produk'];
				$arrSementara['bc']	   = 1;
				$arrSementara['hpp']   = $value['harga_beli'];

				array_push($hasil,$arrSementara);

			}

		}


		echo json_encode($hasil);

	}

	function simpan_penjualan(){
		
		$arrInputGrouping = array(
								'total' 				=> $_POST['total_bayar']+$_POST['potongan'],
								'potongan' 				=> $_POST['potongan'],
								'dipotong' 				=> $_POST['total_bayar'],
								'catatan'				=> $_POST['ctt'],
								'opr' 					=> $_SESSION['data-login']['username'] ,
								'tgl_input' 			=> date("Y-m-d H:i:s"),
								'jumlah_uang_dibayar' 	=> $_POST['jumlah_uang'],
								'kembalian' 			=> $_POST['kembalian']);
		
		
		$id_grouping 	  = $this->mo_toko->insert("grouping_penjualan",$arrInputGrouping);
		
		foreach($_POST['id'] as $key => $post){

			$arrInput = array(
							'id_produk'		 		=> $post,
							'qty'			 		=> $_POST['jml'][$key],
							'harga_produk' 	 		=> $_POST['harga'][$key],
							'total' 		 		=> $_POST['total'][$key],
							'hpp'			 		=> $_POST['hpp'][$key],
							'tgl_input'		 		=> date("Y-m-d H:i:s") ,
							'opr' 			 		=> $_SESSION['data-login']['username'],
							'grouping_penjualan'    => $id_grouping
						);

			$this->mo_toko->insert("penjualan_peritem",$arrInput);
			
			$data_edit = $this->mo_toko->getWhere("data_produk",array('id_produk'=>$post));
			
			if($data_edit['row'] == 1){

				$stok   = isset($data_edit['data'][0]['stok'])?$data_edit['data'][0]['stok']-$_POST['jml'][$key]:0;

				$arrLog = array(
								'id_produk'	   => $post,
								'stok_sesudah' => $stok,
								'stok_sebelum' => isset($data_edit['data'][0]['stok'])?$data_edit['data'][0]['stok']:0,
								'keterangan'   => "Penjualan (Pengurangan)",
								'opr'		   => $_SESSION['data-login']['username']
							   );

				$this->mo_toko->insert("log_stok",$arrLog);
				$this->mo_toko->update("data_produk",array("stok"=>$stok),array('id_produk'=>$post));

			}

		}

		redirect("home");

	}

	function laporan(){

		
		if(isset($_GET['dari'])){

			$_SESSION['dari_laporan'] = @$_GET['dari'];
			redirect('laporan');

		}
		
		if(isset($_GET['sampai'])){

			$_SESSION['sampai_laporan'] = @$_GET['sampai'];
			redirect('laporan');

		}

		

		$cari = null;

		if(isset($_GET['cari'])){

			$txt_dicari = '';
			$txt_cari   = explode(' ',$_GET['cari']);
			$no_cari = 0;
			foreach($txt_cari as $c){
				if($no_cari == 0){
					
					$txt_dicari .= " nama_produk like '%${c}%'";
					
				}else{
					
					$txt_dicari .= " and nama_produk like '%${c}%'";
				}
				
				$no_cari++;
			}

			$cari = $txt_dicari;
			
		}


		$page 					   = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
		$config['base_url']		   = base_url() . 'laporan';
        $config['total_rows']	   = $this->mo_toko->laporanPaging($cari);
        $config['per_page'] 	   = 20;
        $config["uri_segment"]     = 2;
        $config['num_links']       =  4;
        
        //custom paging
		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		// $data["rs"]				   = $this->mo_fastpos->paging_stok($config['per_page'] ,$page*$config['per_page'],$cari,$_SESSION['filter'],$csupp);
  
        $data['laporan']			= $this->mo_toko->laporanall($config["per_page"],$page,$cari);    

		$data['page'] 				= $this->pagination->create_links();
		$data['laporanHasil']		= $this->mo_toko->hitungLaporan();
		$data['laporanPot']			= $this->mo_toko->hitungPotongan();

		// print_r($data['laporanHasil']);
		// print_r($data['laporanPot']);
		// echo "<pre>";
		// print_r($data);
		$this->template('laporan',$data);

	}

	function stok(){
		if(isset($_GET['dari'])){

			$_SESSION['dari_stok'] = @$_GET['dari'];
			redirect('stok');

		}
		
		if(isset($_GET['sampai'])){

			$_SESSION['sampai_stok'] = @$_GET['sampai'];
			redirect('stok');

		}

		

		$cari = null;

		if(isset($_GET['cari'])){

			$txt_dicari = '';
			$txt_cari   = explode(' ',$_GET['cari']);
			$no_cari = 0;
			foreach($txt_cari as $c){
				if($no_cari == 0){
					
					$txt_dicari .= " nama_produk like '%${c}%'";
					
				}else{
					
					$txt_dicari .= " and nama_produk like '%${c}%'";
				}
				
				$no_cari++;
			}

			$cari = $txt_dicari;
			
		}
		
		$page 					   = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
		$config['base_url']		   = base_url() . 'stok';
        $config['total_rows']	   = $this->mo_toko->stokPaging($cari);
        $config['per_page'] 	   = 20;
        $config["uri_segment"]     = 2 ;
        $config['num_links']       = 4 ;
        
        //custom paging
		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		// $data["rs"]				   = $this->mo_fastpos->paging_stok($config['per_page'] ,$page*$config['per_page'],$cari,$_SESSION['filter'],$csupp);
  
        $data['stok']				= $this->mo_toko->stokall($config["per_page"],$page,$cari);    

		$data['page'] 				= $this->pagination->create_links();

		$this->template("stok",$data);

	}

	function simpan_stok(){

		if(isset($_POST['id'])){

			$data_edit = $this->mo_toko->getWhere("data_produk",array('id_produk'=>$_POST['id']));
			
			if($data_edit['row'] > 0){

				$stok_skrg = isset($data_edit['data'][0]['stok'])?$data_edit['data'][0]['stok']:0;
				$stok_baru = $stok_skrg+@$_POST['stok'];

				$arrLog = array(
					'id_produk'	   => $_POST['id'],
					'stok_sesudah' => $stok_baru,
					'stok_sebelum' => $stok_skrg,
					'keterangan'   => "Tambah Stok (Penambahan)",
					'opr'		   => $_SESSION['data-login']['username']
				   );

				$this->mo_toko->insert("log_stok",$arrLog);
				$this->mo_toko->update("data_produk",array("stok"=>$stok_baru),array('id_produk'=>$_POST['id']));


			}

			
		}

		redirect($_SERVER['HTTP_REFERER']);

	}

	function detail_penjualan(){

		$id = @$_GET['id'];
		$data = $this->mo_toko->detail_penjualan($id);

		if($data['row'] > 0){
			$html  = "<h6>{$data['data'][0]['tgl_input']} (<b>{$data['data'][0]['opr']}</b>)</h6><table class='table table-bordered'>";
			$html .= "<tr>
						<td>Nama Produk</td>
						<td>Jumlah</td>
						<td>Harga</td>
						<td>Total</td>
					  </tr>";


			foreach ($data['data'] as $d) {
				
				$html .= "<tr>
							<td>{$d['nama_produk']}</td>
							<td>{$d['qty']}</td>
							<td>{$d['harga_produk']}</td>
							<td>{$d['total']}</td>
						  </tr>";

			}
		
			$html .="</table>";


			$dataGp = $this->mo_toko->getWhere('grouping_penjualan',array('id_terjual'=>$id));
			if($dataGp['row'] > 0){

				$html .= "<table class='table table-bordered mt-2'>
							<tr>
								<td>Total</td>
								<td>potongan</td>
								<td>Jumlah uang</td>
								<td>Kembalian</td>
							</tr>
							<tr>
								<td>{$dataGp['data'][0]['total']}</td>
								<td>{$dataGp['data'][0]['potongan']}</td>
								<td>{$dataGp['data'][0]['jumlah_uang_dibayar']}</td>
								<td>{$dataGp['data'][0]['kembalian']}</td>
							</tr>	
						  </table>";


			}
			echo $html;
		}

	}




	function logout(){

		session_destroy() ;
		redirect();

	}

	//untuk template
	public function template($file = null, $data = null){
		
		// ambil settingan toko (nama)
		$data['settingan'] = $this->mo_toko->getAll('setting')['data']; 

		$this->load->view('header.php',$data);  // view header
		$this->load->view($file.'.php'); 		// view utama
		$this->load->view('footer.php'); 		// view footer

	}



}
