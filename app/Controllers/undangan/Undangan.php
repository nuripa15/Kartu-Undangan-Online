<?php namespace App\Controllers\undangan;

use CodeIgniter\Controller;
use App\Models\undangan\UndanganModel;

class Undangan extends Controller
{

	//mendefinisikan variable agar bisa digunakan
	//secara global
	protected $UndanganModel;
	protected $uri;

	public function __construct() {
		
		//mengisi variable global dengan data
		$this->UndanganModel = new UndanganModel(); 
        $this->session = session();
		$request = \Config\Services::request(); //memanggil class request
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
    }

	public function index()
	{
		// return redirect()->to(DOMAIN_UTAMA); //redirect ke domain utama
		echo 'URL Tidak Valid / Kurang Lengkap';

	}

	public function undangan()
	{
		
		$web = $this->uri->getSegment(2); //memabaca domain user
		$invite = $this->uri->getSegment(3); //orang yang diundang disini

		$data['web'] = urldecode($web);
		$data['invite'] = urldecode($invite);
		
		//melakukan pengeceakan ke database
		$cekDomain = $this->UndanganModel->cek_domain(urldecode($web));

		//jika ditemukan lanjut ke proses selanjutnya
		if(!empty($cekDomain->getResult())){
			
			//jika data ditemukan maka kita akan ambil id_user nya
			foreach ($cekDomain->getResult() as $row)
			{
				$idnya = $row->id_user;
				$this->session->set('id_user',$idnya); //save di session untuk di load jika komentar
			}
			
			//id_user kemudian digunakan untuk mengambil semua data yang dibutuhkan
			$data['mempelai'] = $this->UndanganModel->get_mempelai($idnya);
			$data['acara'] = $this->UndanganModel->get_acara($idnya);
			$data['komen'] = $this->UndanganModel->get_komen($idnya);
			$data['data'] = $this->UndanganModel->get_data($idnya);
			$data['cerita'] = $this->UndanganModel->get_cerita($idnya);
			$data['album'] = $this->UndanganModel->get_album($idnya);
			$data['rules'] = $this->UndanganModel->get_rules($idnya);

			//cek pada tabel order untuk mengambil tema yang digunakan user
			$ordernya = $this->UndanganModel->get_order($idnya);

			//ini untuk mendefinisikan tema undangan secara default 
			//apabila tema yang direquest user tidak ditemukan
			$temanya = 'modernrose';
			
			//jika tema ditemukan maka
			//variabel tema akan di 'repleace' sesuai tema pilihan user
			foreach ($ordernya->getResult() as $row){ 
				$temanya = $row->nama_theme;
			}

			//insert traffic to db
			if($invite != NULL){
				$dataTraffic['nama_pengunjung'] = urldecode($invite);
			}else{
				$dataTraffic['nama_pengunjung'] = "Unknown";
			}
			$dataTraffic['id_user'] = $idnya;
			$dataTraffic['addr'] = $this->get_client_ip();

			$this->UndanganModel->insert_traffic($dataTraffic);
			

			//kirim semua data pada view
			return view('undangan/themes/'.$temanya, $data);
		}else{
			return $this->index();
		}
	}

	public function do_add_komentar(){
		$data['nama_komentar'] = $this->request->getPost('nama');
		$data['isi_komentar'] = $this->request->getPost('komentar');
		$data['id_user'] = $_SESSION['id_user'];

		$update = $this->UndanganModel->add_komen($data);
		if($update){
			echo json_encode(array('status' => 'sukses','nama' => \esc($data['nama_komentar']),'komentar' => \esc($data['isi_komentar']) ));
		}else{
			echo json_encode(array('status' => 'gagal'));
		}

	}

	// Function to get the client IP address
	public function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = '0';
		return $ipaddress;
	}

}