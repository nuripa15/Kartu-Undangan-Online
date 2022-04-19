<?php namespace App\Controllers\base;

use CodeIgniter\Controller;
use App\Models\base\OrderModel;

class Order extends Controller
{
	
	protected $order,$uri,$request,$db;

	public function __construct() {
		// parent::__construct();

		//load service bawaan ci
		$this->request = \Config\Services::request(); 
		$this->session = \Config\Services::session();  //untuk membaca session 
		$this->db  = \Config\Database::connect(); //untuk melakukan CRUD ke databse

        $this->order = new OrderModel();  //load OrderModel
		$this->uri = $this->request->uri;
    }

	public function index()
	{

		$kode = $this->uri->getSegment(3); //untuk membaca tema yang dipilih user atau membaca session order

		if($this->session->get('theme') == '' && $kode == '1'){
			return redirect()->to(base_url('/tema'));
			exit();
		}

		if($kode != '1' && $this->session->get('theme') == ''){
			$cekTheme = $this->order->cek_themes($kode);
			if(!empty($cekTheme->getResult())){
				foreach ($cekTheme->getResult() as $row)
				{
				    $idnya = $row->id;
				}
				$this->session->set('theme', $idnya);
				$this->session->set('checkpoint', 1);
			}else{
				return redirect()->to(base_url('/tema'));
				exit();
			}
		}
		
		$data['domain'] = $this->session->domain;
		$data['email'] = $this->session->email;
		$data['hp'] = $this->session->hp;
		$data['password'] = $this->session->password;
		$data['view'] = 'base/order/order1-datauser';

		//cek session 
		$check = $this->session->get('checkpoint');
		if($check == 1 || $kode == '1'){
			return view('base/order/order_layout',$data);
		}else{
			return redirect()->route('order/any');
		}

	}

	public function mempelai()
	{

		// cek pengiriman data & simpan form data sebelumnya (awal)
		$submit = $this->request->getPost('submit');
		if($submit != NULL){

			//ambil data dari post sebelumnya
			//dan cek domain
			//jika domain sudah digunakan 
			//maka akan dikembalikan ke halaman sebelumnya (awal)
			$domain = $this->request->getPost('domain');
			$email = $this->request->getPost('email');
			$password = $this->request->getPost('password');  
			$hp = $this->request->getPost('hp');   
			$cekDomain = $this->order->cek_domain($domain);
			if(!empty($cekDomain->getResult())){
				echo "<script>
					alert('Nama domain sudah dipakai. Gunakan nama domain lain!');
					document.location.href='order/any';
					</script>";
					exit();
			}

			//jika domain tersedia maka
			//simpan datanya kedalam session
			$this->session->set('domain', $domain);
			$this->session->set('email', $email);
			$this->session->set('password', $password);
			$this->session->set('hp', $hp);
			
			//buatkan data dummynya
			//untuk identitas sementara
			$c = $this->session->get('checkpoint');
			if($c <= 2 && $this->session->get('dummy') == ''){
				$this->session->set('checkpoint', 2);
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			    $charactersLength = strlen($characters);
			    $randomString = '';
			    for ($i = 0; $i < 7; $i++) {
			        $randomString .= $characters[rand(0, $charactersLength - 1)];
			    }
			    $generate = "dummy_".$randomString;
			    $this->session->set('dummy', $generate);
			}
			
		}

		//set view data
		$data['view'] = 'base/order/order2-mempelai';

		//cek session 
		$check = $this->session->get('checkpoint');
		if($check >= 2){
			return view('base/order/order_layout',$data);
		}else{
			return redirect()->route('order/any');
		}
		
	}

	public function acara(){

		// cek pengiriman data & simpan form data sebelumnya
		$submit = $this->request->getPost('submit');
		if(isset($submit)){

			//simpan data sebelumnya ke session
			$this->simpan_data_sessions('mempelai');
			
			//set checkpoint
			$c = $this->session->get('checkpoint');
			if($c <= 3){
				$this->session->set('checkpoint', 3);
			}
		}

		//set data for view
		$data['view'] = 'base/order/order3-acara';

		// cek session domain
		$check = $this->session->get('checkpoint');
		if($check >= 3){
			return view('base/order/order_layout',$data);
		}else{
			return redirect()->route('order/any');
		}

	}

	public function cerita(){

		$submit = $this->request->getPost('submit');
		if(isset($submit)){
			
			//simpan data sebelumnya ke session
			$this->simpan_data_sessions('acara');

			//set checkpoint
			$c = $this->session->get('checkpoint');
			if($c <= 4){
				$this->session->set('checkpoint', 4);
			}
		}

		//set data for view
		$data['view'] = 'base/order/order4-cerita';

		// cek session domain
		$check = $this->session->get('checkpoint');
		if($check >= 4){
			return view('base/order/order_layout',$data);
		}else{
			return redirect()->route('order/any');
		}
	}

	public function gallery(){

		$submit = $this->request->getPost('submit');

		if(isset($submit)){

			//simpan data sebelumnya ke session
			$this->simpan_data_sessions('cerita');
					
			//set checkpoint
			$c = $this->session->get('checkpoint');
			if($c <= 5){
				$this->session->set('checkpoint', 5);
			}

		}

		//set data for view
		$data['view'] = 'base/order/order5-gallery';

		// cek session domain
		$check = $this->session->get('checkpoint');
		if($check >= 5){
			// $this->session->set('save', 1);
			return view('base/order/order_layout',$data);
		}else{
			return redirect()->route('order/any');
		}
	}

	public function simpan_data_sessions($indentifier){

		switch ($indentifier) {

			case 'mempelai':

				$dataMempelai = [
					//pria
					'nama_lengkap_pria'  => $this->request->getPost('nama_lengkap_pria'),
					'nama_panggilan_pria'  => $this->request->getPost('nama_panggilan_pria'),
					'nama_ayah_pria'  => $this->request->getPost('nama_ayah_pria'),
					'nama_ibu_pria'  => $this->request->getPost('nama_ibu_pria'),
					'w_ayah_pria'  => $this->request->getPost('w_ayah_pria'),
					'w_ibu_pria'  => $this->request->getPost('w_ibu_pria'),
	
					//wanita
					'nama_lengkap_wanita'  => $this->request->getPost('nama_lengkap_wanita'),
					'nama_panggilan_wanita'  => $this->request->getPost('nama_panggilan_wanita'),
					'nama_ayah_wanita'  => $this->request->getPost('nama_ayah_wanita'),
					'nama_ibu_wanita'  => $this->request->getPost('nama_ibu_wanita'),
					'w_ayah_wanita'  => $this->request->getPost('w_ayah_wanita'),
					'w_ibu_wanita'  => $this->request->getPost('w_ibu_wanita'),
	
				];

				$this->session->set($dataMempelai);
				break;

			case 'acara':

				$dataAcara = [
					//akad
					'tanggal_akad'  => $this->request->getPost('tanggal_akad'),
					'waktu_akad'  => $this->request->getPost('waktu_akad'),
					'lokasi_akad'  => $this->request->getPost('lokasi_akad'),
					'alamat_akad'  => $this->request->getPost('alamat_akad'),
	
					//akad
					'tanggal_resepsi'  => $this->request->getPost('tanggal_resepsi'),
					'waktu_resepsi'  => $this->request->getPost('waktu_resepsi'),
					'lokasi_resepsi'  => $this->request->getPost('lokasi_resepsi'),
					'alamat_resepsi'  => $this->request->getPost('alamat_resepsi'),
					'maps_resepsi'  => $this->request->getPost('maps_resepsi'),
	
				];
				$this->session->set($dataAcara);
				break;

			case 'cerita': 

				$skipCerita = $this->request->getPost('skipCerita');
				$this->session->set('skipCerita', $skipCerita);
				
				$noTanggal = 0;
				$noJudul = 0;
				$noIsi = 0;
	
				$jml_cerita_sebelumnya = $this->session->get('jml_cerita');
	
				for($i=0;$i<=$jml_cerita_sebelumnya;$i++){
					$this->session->remove('tanggal_cerita'.$i);
					$this->session->remove('judul_cerita'.$i);
					$this->session->remove('isi_cerita'.$i);
				}
	
				foreach ($this->request->getPost('tanggal_cerita') as $value) {
					$this->session->set('tanggal_cerita'.$noTanggal++, $value); 
					if($value == "")
						continue;
				}
	
				foreach ($this->request->getPost('judul_cerita') as $value) {
					$this->session->set('judul_cerita'.$noJudul++, $value); 
				}
	
				foreach ($this->request->getPost('isi_cerita') as $value) {
					$this->session->set('isi_cerita'.$noIsi++, $value); 
				}
	
				$this->session->set('jml_cerita', $noTanggal); 
				break;

			default:
				return redirect()->route('order'); 
				break;
		}

	}


	//checkpoint jika session checkpoint tidak sesuai akan 'dilempar' sesuai sessionnya
	//misal, jika masih di tahap order 1 tidak akan bisa langsung loncat ke order 5 dsb
	public function any(){

		$checkpoint = $this->session->get('checkpoint');
		switch ($checkpoint) {
			case 1:
				return redirect()->route('order/1'); 
				break;
			case 2:
				return redirect()->route('order/2'); 
				break;
			case 3:
				return redirect()->route('order/3'); 
				break;
			case 4:
				return redirect()->route('order/4'); 
				break;
			case 5:
				return redirect()->route('order/5'); 
				break;
			default:
				return redirect()->route('order'); 
				break;
		}
		
	}


	// upload foto gallery
	public function fileUpload(){

		$check = $this->session->get('checkpoint');
		if($check != 5){
			return redirect()->route('order/any');
			exit();
		}

        $avatar = $this->request->getFile('file');
        $generate = $this->session->get('dummy'); //data dummy yg tadi dibuat untuk penyimpanan foto sementara
        $path = 'assets/users/'.$generate;
        
        //folder e
        if(!file_exists($path)){
        	$create = mkdir('assets/users/'.$generate, 0777,true);
        }

        //generate dan cek nama file
        for($i=1;$i<=10;$i++){
        	$pathName = 'assets/users/'.$generate.'/album'.$i.'.png';
        	if(!file_exists($pathName)){
        		$ok = array("no"=>$i,"dummy"=>$generate);
        		$avatar->move('assets/users/'.$generate, 'album'.$i.'.png');
        		echo json_encode($ok);
        		break;
        	} 
        }


	 }

	 //upload foto mempelai
	 public function imgupload(){

		$check = $this->session->get('checkpoint');
		if($check < 2){
			return redirect()->route('order/any');
			exit();
		}

        $groom = $this->request->getFile('foto_groom');
        $bride = $this->request->getFile('foto_bride');
        $sampul = $this->request->getFile('foto_sampul');
        $generate = $this->session->get('dummy');
        $path = 'assets/users/'.$generate;
        
        //buat folder ny
        if(!file_exists($path)){
        	$create = mkdir('assets/users/'.$generate, 0777,true);
        }

        if($groom != ''){
        	$avatar = $groom;
        	$pathName = 'assets/users/'.$generate.'/groom.png';
        	if(file_exists($pathName)){
        		unlink($pathName);
	    	} 
				$avatar->move('assets/users/'.$generate, 'groom.png');
				$this->session->set('foto_groom', 1);
				echo 'uploadedgroom';
		}else if($bride != ''){
        	$avatar = $bride;
        	$pathName = 'assets/users/'.$generate.'/bride.png';
        	if(file_exists($pathName)){
        		unlink($pathName);
	    	} 
	    	$avatar->move('assets/users/'.$generate, 'bride.png');
    		$this->session->set('foto_bride', 1);
			echo 'uploadedbride';
			
        }else{
        	$avatar = $sampul;
        	$pathName = 'assets/users/'.$generate.'/kita.png';
        	if(file_exists($pathName)){
        		unlink($pathName);
	    	} 
	    	$avatar->move('assets/users/'.$generate, 'kita.png');
    		$this->session->set('foto_sampul', 1);
    		echo 'uploadedsampul';
        } 	


	 }

	//  hapus foto gallery
	 public function del(){

	 	$check = $this->session->get('checkpoint');
		if($check != 5){
			return redirect()->route('order/any');
			exit();
		}

	 	$id = $this->request->getPost('id');
        $generate = $this->session->get('dummy');
        $file = 'assets/users/'.$generate.'/album'.$id.'.png';
        unlink($file);
        echo json_encode("sukses");


	 }

	 public function finish(){

	 	$submit = $this->request->getPost('submit');
	 	if(isset($submit)){

			$skipGallery = $this->request->getPost('skipGallery');
			$this->session->set('skipGallery', $skipGallery);

		}

	 	//set data for view
		$data['view'] = 'base/order/order6-finish';

		// cek session domain
		$check = $this->session->get('checkpoint');
		if($check == 5){
			$this->session->set('save', 1);
			return view('base/order/order_layout',$data);
		}else{
			return redirect()->route('order/any');
		}
	 }

	 public function success(){
	 	$kode = $this->uri->getSegment(4);
	 	if(!empty($kode)){
	 		$cekOrder = $this->order->cek_order($kode);
			if(!empty($cekOrder->getResult())){
				foreach ($cekOrder->getResult() as $row)
				{
				    $id = $row->id_user;
				    $kode = $row->invoice;
				    $domain = $row->domain;
				    $username = $row->username;
				    $status = $row->statusPembayaran;

				}
				$data['view'] = 'base/order/order7-success';
				$data['domain'] = $domain;
				$data['kode'] = $kode;
				$data['status'] = $status;

				// set session login
				$ok = array('masukUser' => TRUE, 'uname' => $username, 'id' => $id);
				$this->session->set($ok);

				// $this->session->destroy();
				return view('base/order/order_layout',$data);

			}else{
				return redirect()->route('order/any');
			}
	 	}else{
	 		return redirect()->route('order/any');
	 	}
	}


	 public function saveData(){

	 	$check = $this->session->get('checkpoint');
	 	$check2 = $this->session->get('save');
		if($check < 5 && $check2 != 1){
			return redirect()->route('order/any');
			exit();
		}

		$email = $this->session->get('email');
		$domain = $this->session->get('domain');

		//untuk menghindari doubble insert ketika ditekan tombol back setealh success
		$cekUser = $this->order->cek_email($email);
		if(!empty($cekUser->getResult())){
			$cekOrder = $this->order->cek_order_domain($domain);
			if(!empty($cekOrder->getResult())){
				foreach ($cekOrder->getResult() as $row)
				{
					$kodenya = $row->kunci;

				}

				return redirect()->to(base_url('/order/success/'.$kodenya));

			}else{
				echo "Terjadi Kesalahan"; //user berhasil daftar tapi data tidak masuk semua (interupt)
				exit();
			}
		}

		//users
	 	$hp = $this->session->get('hp');
	 	$username = $email;
	 	$password = $this->session->password;

	 	$dataUser = [
	 		'email' => $email,
	 		'hp' => $hp,
	 		'username' => $username,
	 		'password' => md5($password),
	 		'id_unik' => '',
	 	];
		
		//insert dulu data user nya nanti diambil idnya 
	 	$saveUser = $this->order->save_user($dataUser);
	 	if(!$saveUser){
	 		echo "<script>
					alert('Terjadi Kesalahan! Silahkan coba beberapa saat lagi!');
					document.location.href='order/any';
					</script>";
					exit();
	 	}
		
	 	//global
	 	$id_user = $this->db->insertID(); //ambil id user
		$today = date('ym');
	 	$kode = $today.$id_user.rand(10,99); //dijadikan invoice sekaligus kode unik user. Formatnya ( 2 digit tahun, 2 digit bulan, id user, random 2 angka)
	 	$this->order->update_kode($kode,$id_user);

	 	//mempelai	
	 	$nama_lengkap_pria = $this->session->get('nama_lengkap_pria');
	 	$nama_panggilan_pria = $this->session->get('nama_panggilan_pria');
	 	$nama_ibu_pria = $this->session->get('nama_ibu_pria');
	 	$nama_ayah_pria = $this->session->get('nama_ayah_pria');

	 	$nama_lengkap_wanita = $this->session->get('nama_lengkap_wanita');
	 	$nama_panggilan_wanita = $this->session->get('nama_panggilan_wanita');
	 	$nama_ibu_wanita = $this->session->get('nama_ibu_wanita');
	 	$nama_ayah_wanita = $this->session->get('nama_ayah_wanita');
		 
	 	$dataMempelai = [
	 		'id_user' => $id_user,
	 		'nama_pria' => $nama_lengkap_pria,
	 		'nama_panggilan_pria' => $nama_panggilan_pria,
	 		'nama_ibu_pria' => $nama_ibu_pria,
	 		'nama_ayah_pria' => $nama_ayah_pria,
	 		'nama_wanita' => $nama_lengkap_wanita,
	 		'nama_panggilan_wanita' => $nama_panggilan_wanita,
	 		'nama_ibu_wanita' => $nama_ibu_wanita,
	 		'nama_ayah_wanita' => $nama_ayah_wanita,
	 	];


	 	//order
	 	$theme = $this->session->get('theme');

	 	$dataOrder = [
	 		'id_user' => $id_user,
	 		'domain' => $domain,
	 		'theme' => $theme,
	 		'status' => '1'

	 	];

	 	//acara

	 	$tanggal_akad = $this->session->get('tanggal_akad');
	 	$waktu_akad = $this->session->get('waktu_akad');
	 	$lokasi_akad = $this->session->get('lokasi_akad');
	 	$alamat_akad = $this->session->get('alamat_akad');

	 	$tanggal_resepsi = $this->session->get('tanggal_resepsi');
	 	$waktu_resepsi = $this->session->get('waktu_resepsi');
	 	$lokasi_resepsi = $this->session->get('lokasi_resepsi');
		$alamat_resepsi = $this->session->get('alamat_resepsi');
		 
		$maps =  $this->session->get('maps_resepsi');

	 	$dataAcara = [
	 		'id_user' => $id_user,
	 		'tanggal_akad' => $tanggal_akad,
	 		'jam_akad' => $waktu_akad,
	 		'tempat_akad' => $lokasi_akad,
	 		'alamat_akad' => $alamat_akad,
	 		'tanggal_resepsi' => $tanggal_resepsi,
	 		'jam_resepsi' => $waktu_resepsi,
	 		'tempat_resepsi' => $lokasi_resepsi,
	 		'alamat_resepsi' => $alamat_resepsi
	 	];

	 	//cerita
	 	$skipCerita = $this->session->get('skipCerita');
	 	$cerita = 0;
		if($skipCerita == ''){
			$jml_cerita = $this->session->get('jml_cerita');

			for($i=0;$i<$jml_cerita;$i++){
				$tanggal_cerita = $this->session->get('tanggal_cerita'.$i);
				$judul_cerita = $this->session->get('judul_cerita'.$i);
				$isi_cerita = $this->session->get('isi_cerita'.$i);

				$dataCerita = [
					'id_user' => $id_user,
					'tanggal_cerita' => $tanggal_cerita,
					'judul_cerita' => $judul_cerita,
					'isi_cerita' => $isi_cerita
				];

				$saveCerita = $this->order->save_cerita($dataCerita);
			}
			$cerita = 1;
		}
		

		//gallery
		$skipGallery = $this->session->get('skipGallery');
		$video = '';
		$gallery = 0;
		$generate = $this->session->get('dummy');
		if($skipGallery == ''){
			for($a=1;$a<=10;$a++){
		      $pathName = 'assets/users/'.$generate.'/album'.$a.'.png';
		      if(!file_exists($pathName))continue;
		      $dataAlbum = [
		      	'id_user' => $id_user,
		      	'album' => 'album'.$a

		      ];

		      $saveAlbum = $this->order->save_album($dataAlbum);
			}
			$video = '';
			$gallery = 1;
		}

		$foto_pria = $this->session->get('foto_groom');
		$foto_wanita = $this->session->get('foto_bride');
		if($foto_pria == null){
			$foto_pria = "0";
		}
		if($foto_wanita == null){
			$foto_wanita = "0";
		}
		$kunci = md5($id_user.$domain);
		$folder = 'assets/users/'.$generate;
		$folderBaru = 'assets/users/'.$kunci;
		exec("mv $folder $folderBaru");

		$dataData = [
			'id_user' => $id_user,
			'foto_pria' => $foto_pria,
			'foto_wanita' => $foto_wanita,
			'video' => $video,
			'kunci' => $kunci,
			'maps' => $maps,
			'salam_pembuka' => "Assalamu'alaikum warahmatullahi wabarakatuh\nDengan memohon rahmat dan ridho Allah SWT, Kami akan menyelenggarakan resepsi pernikahan Putra-Putri kami :
			",
		];

		//rule
		$dataRules = [
			'id_user' => $id_user,
			'sampul' => 1,
			'mempelai' => 1,
			'acara' => 1,
			'komen' => 1,
			'gallery' => $gallery,
			'cerita' => $cerita,
			'lokasi' => 1,
		];

		//pembayaran
		$dataPembayaran = [
			'id_user' => $id_user,
			'invoice' => $kode,
			'status' => '0'
		];

		$savePembayaran = $this->order->save_pembayaran($dataPembayaran);
		$saveRules = $this->order->save_rules($dataRules);
		$saveData = $this->order->save_data($dataData);
	 	$saveAcara = $this->order->save_acara($dataAcara);
	 	$saveOrder = $this->order->save_order($dataOrder);
		$saveUser = $this->order->save_mempelai($dataMempelai);

	 	if($saveUser){

			$this->session->destroy();
	 		return redirect()->to(base_url('/order/success/'.$kunci));
	 	}else{
	 		echo "gagal";
	 	}

	 }

}