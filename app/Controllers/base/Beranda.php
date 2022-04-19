<?php namespace App\Controllers\base;

use CodeIgniter\Controller;
use App\Models\base\BerandaModel; //load BerandaModel

class Beranda extends Controller
{

	//mendefinisikan variable agar bisa digunakan
	//secara global
	protected $BerandaModel;

	public function __construct() {
        
		$request = \Config\Services::request();

		//mengisi variable global dengan data
		$this->BerandaModel = new BerandaModel();  //load BerandaModel
		$request = \Config\Services::request(); //memanggil class request
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
    }

	public function index()
	{
		//mengambil semua data themes dari BerandaModel
		$data['tema'] = $this->BerandaModel->get_all_themes();
		//load view home
		return view('base/beranda/home', $data);
	}

	 public function themes()
	{
		//mengambil semua data themes dari BerandaModel
		$data['tema'] = $this->BerandaModel->get_all_themes();

		//kirim data ke view
		return view('base/beranda/tema',$data);

	}

	public function demo(){

		$idnya = '1'; //id user khusus demo
		$temanya = $this->uri->getSegment(3); //get tema
		$invite = $this->uri->getSegment(4); //get invited user
		//cek apkah temanya ada ?
		$cek = $this->BerandaModel->get_themes_by_name(urldecode($temanya));
		if(count($cek) > 0){

			//get all data
			$data['web'] = urldecode('reydinda');
			$data['invite'] = urldecode($invite);
			$data['mempelai'] = $this->BerandaModel->get_mempelai($idnya);
			$data['acara'] = $this->BerandaModel->get_acara($idnya);
			$data['komen'] = $this->BerandaModel->get_komen($idnya);
			$data['data'] = $this->BerandaModel->get_data($idnya);
			$data['cerita'] = $this->BerandaModel->get_cerita($idnya);
			$data['album'] = $this->BerandaModel->get_album($idnya);
			$data['rules'] = $this->BerandaModel->get_rules($idnya);

			return view('undangan/themes/'.$temanya, $data);

		}else{
			echo "URL Tidak Valid / Kurang Lengkap";
		}

	}

	public function youtube()
	{
		return view('base/youtube');
	}

	public function maps()
	{
		return view('base/maps');
	}
}