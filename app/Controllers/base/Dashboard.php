<?php namespace App\Controllers\base;

use CodeIgniter\Controller;
use App\Models\base\DashboardModel;

class Dashboard extends Controller
{
    public function __construct() {
        //mengisi variable global dengan data
        $this->session = session();
        $this->DashboardModel = new DashboardModel(); 
		$this->request = \Config\Services::request(); //memanggil class request
        $this->uri = $this->request->uri; //class request digunakan untuk request uri/url
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['view'] = 'base/dashboard/index';
        $data['pembayaran'] = $this->DashboardModel->get_pembayaran_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user(); 
        $data['total_pengunjung'] = $this->DashboardModel->get_total_pengunjung();
        $data['total_komentar'] = $this->DashboardModel->get_total_komentar();
        $data['total_mingguan'] = $this->DashboardModel->get_total_pengunjung_mingguan();
        $data['komentar'] = $this->DashboardModel->get_all_komen();
        $data['pengunjung'] = $this->DashboardModel->get_all_pengunjung();

        return view('base/dashboard/layout', $data);
        // echo $_SESSION['id'];
    }

    public function do_auth(){

        $data['email'] = $this->request->getPost('email');
        $data['password'] = md5($this->request->getPost('password'));
        $hasil = $this->DashboardModel->get_user($data);
        
        if(count($hasil) > 0)
        {
            // set session
            $sess_data = array('masukUser' => TRUE, 'uname' => $hasil[0]->username, 'id' => $hasil[0]->id);
            $this->session->set($sess_data);
            return redirect()->to(base_url('user/dashboard'));
            exit();
        }
        else
        {
            $this->session->setFlashdata('errors', ['Password Salah']);
            return redirect()->to(base_url('/login'));
        }
		
    }
    
    public function do_unauth(){

        $this->session->destroy();
        return redirect()->to(base_url('/login'));
		
	}

    public function login()
    {
        if(session()->has('masukUser'))
        {
        	return redirect()->to(base_url('user/dashboard'));
        }
        $data['title'] = 'Selamat Datang!';
        $data['view'] = 'base/dashboard/auth/login';
        return view('base/dashboard/auth/layout', $data);
    }

    public function riwayat()
    {
        $data['title'] = 'Riwayat Pengunjung';
        $data['view'] = 'base/dashboard/riwayat';
        $data['total_pengunjung'] = $this->DashboardModel->get_total_pengunjung();
        $data['total_pengunjung_today'] = $this->DashboardModel->get_total_pengunjung_today();
        $data['total_mingguan'] = $this->DashboardModel->get_total_pengunjung_mingguan();
        $data['pengunjung'] = $this->DashboardModel->get_all_pengunjung();

        return view('base/dashboard/layout', $data);
    }

    public function ucapan()
    {
        $data['title'] = 'Data Ucapan';
        $data['view'] = 'base/dashboard/komentar';
        $data['total_komentar'] = $this->DashboardModel->get_total_komentar();
        $data['total_komentar_today'] = $this->DashboardModel->get_total_komentar_today();
        $data['komentar'] = $this->DashboardModel->get_all_komen();

        return view('base/dashboard/layout', $data);
    }

    public function do_hapus_komentar(){
        $idkomentar = $this->request->getPost('id');
        $hapus = $this->DashboardModel->delete_komen_by_id($idkomentar);
        if($hapus){
            echo 'sukses';
        }else{
            echo 'gagal';
        }
    }

    public function tampilan()
	{
        
        $data['tema'] = $this->DashboardModel->get_all_themes(); 
        $data['order'] = $this->DashboardModel->get_order_by_id_user(); 
        $data['title'] = 'Tampilan Undangan';
        $data['view'] = 'base/dashboard/tampilan';
		//load view home
		return view('base/dashboard/layout', $data);
    }
    
    public function do_ganti_tema()
	{
        $data['theme'] = $this->request->getPost('id');
        $ganti = $this->DashboardModel->update_tema($data);
        if($ganti){
            echo 'sukses';
        }else{
            echo 'gagal';
        }
    }
    
    public function pengaturan()
	{
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['fitur'] = $this->DashboardModel->get_fitur_by_id_user();
        $data['title'] = 'Pengaturan Undangan';
        $data['view'] = 'base/dashboard/pengaturan';
		return view('base/dashboard/layout', $data);
    }

    public function do_update_fitur(){
        $data['cerita'] = $this->request->getPost('cerita');
        $data['gallery'] = $this->request->getPost('album');
        $data['komen'] = $this->request->getPost('ucapan');
        $data['lokasi'] = $this->request->getPost('lokasi');
        $update = $this->DashboardModel->update_fitur($data);
        if($update){
            echo 'sukses';
        }else{
            echo 'gagal';
        }
    }

    public function do_update_domain(){
        $domain = $this->request->getPost('domain');

        if($domain != ''){
            $cek = $this->DashboardModel->cek_domain($domain); //cek dulu domain yg direkuest jika sdh ada maka feedback error
            if(count($cek) > 0){
                echo 'gagal';
                exit;
            }else{
                $update = $this->DashboardModel->update_domain($domain);
                if($update){
                    echo 'sukses';
                }else{
                    echo 'gagal';
                }
            }   
        }
    }

    public function do_update_musik(){
        
        $musik = $this->request->getFile('musik');
        $data = $this->DashboardModel->get_data_by_id_user();
        $kunci = $data[0]->kunci;
        $path = 'assets/users/'.$kunci;
        echo $musik->getName();;
        if (! $musik->isValid())
        {
            //jika file lebih dari 2mb
            //jika ingin lebih dari 2mb silahkan edit file php.ini (googling ya :) )
            return redirect()->to(base_url('user/pengaturan'));
        }
        //cek folder e
        if(!file_exists($path)){
            $create = mkdir('assets/users/'.$kunci, 0777,true);
        }

        $pathName = 'assets/users/'.$kunci.'/musik.mp3';
        if(file_exists($pathName)){
            unlink($pathName);
        } 

        $musik->move('assets/users/'.$kunci,'musik.mp3');
        return redirect()->to(base_url('user/pengaturan'));

    }

    public function mempelai()
	{
        $data['mempelai'] = $this->DashboardModel->get_mempelai_by_id_user();
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Data Mempelai';
        $data['view'] = 'base/dashboard/mempelai';
		return view('base/dashboard/layout', $data);
    }

    //upload foto mempelai
	 public function do_update_foto_mempelai(){

        $groom = $this->request->getFile('foto_groom');
        $bride = $this->request->getFile('foto_bride');
        $sampul = $this->request->getFile('foto_sampul');
        $kunci = $this->request->getPost('kunci');
        $path = 'assets/users/'.$kunci;
        
        //cek folder e
        if(!file_exists($path)){
        	$create = mkdir('assets/users/'.$kunci, 0777,true);
        }
         
        if($groom != ''){ //cek dulu ini fotonya siapa
        	$avatar = $groom;
        	$pathName = 'assets/users/'.$kunci.'/groom.png';
        	if(file_exists($pathName)){
        		unlink($pathName); //hapus dulu foto yg lama
	    	} 
				$avatar->move('assets/users/'.$kunci, 'groom.png'); //upload yg baru
				echo 'uploadedgroom'; //give feedback ke jquery.. agar tampilan fotonya di ubah dgn yg baru
        }else if($bride != ''){
            $avatar = $bride;
            $pathName = 'assets/users/'.$kunci.'/bride.png';
            if(file_exists($pathName)){
                unlink($pathName);
            } 
            $avatar->move('assets/users/'.$kunci, 'bride.png');
            $this->session->set('foto_bride', 1);
            echo 'uploadedbride';
            
        }else{
            $avatar = $sampul;
            $pathName = 'assets/users/'.$kunci.'/kita.png';
            if(file_exists($pathName)){
                unlink($pathName);
            } 
            $avatar->move('assets/users/'.$kunci, 'kita.png');
            $this->session->set('foto_sampul', 1);
            echo 'uploadedsampul';
        } 	


     }
     
     public function do_update_mempelai(){
         
        $datanyaSiapa = $this->request->getPost('datanyaSiapa'); //cara cepat pake variabel :)
        $data["nama_".$datanyaSiapa] = $this->request->getPost('nama');
        $data['nama_panggilan_'.$datanyaSiapa] = $this->request->getPost('nama_panggilan');
        $data['nama_ayah_'.$datanyaSiapa] = $this->request->getPost('nama_ayah');
        $data['nama_ibu_'.$datanyaSiapa] = $this->request->getPost('nama_ibu');

        $update = $this->DashboardModel->update_mempelai($data);
        if($update){
            echo 'sukses';
        }else{
            echo 'gagal';
        }
     }

     public function acara(){

        $data['acara'] = $this->DashboardModel->get_acara_by_id_user();
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Data Acara';
        $data['view'] = 'base/dashboard/acara';
		return view('base/dashboard/layout', $data);
     }

    public function do_update_acara(){
         
        $datanyaSiapa = $this->request->getPost('datanyaSiapa'); //cara cepat pake variabel :)
        $data["tanggal_".$datanyaSiapa] = $this->request->getPost('tanggal');
        $data['jam_'.$datanyaSiapa] = $this->request->getPost('waktu');
        $data['tempat_'.$datanyaSiapa] = $this->request->getPost('lokasi');
        $data['alamat_'.$datanyaSiapa] = $this->request->getPost('alamat');

        $update = $this->DashboardModel->update_acara($data);
        if($update){
            echo 'sukses';
        }else{
            echo 'gagal';
        }
    }

    public function do_update_maps(){
         
        $data['maps'] = $this->request->getPost('maps');

        $update = $this->DashboardModel->update_maps($data);
        if($update){
            echo 'sukses';
        }else{
            echo 'gagal';
        }
    }

    public function gallery(){

        $data['album'] = $this->DashboardModel->get_album_by_id_user();
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Data Gallery';
        $data['view'] = 'base/dashboard/gallery';
		return view('base/dashboard/layout', $data);
    }

    public function do_update_video(){
         
        $data['video'] = $this->request->getPost('video');

        $update = $this->DashboardModel->update_video($data);
        if($update){
            echo 'sukses';
        }else{
            echo 'gagal';
        }
    }

    // upload foto gallery
	public function do_update_gallery(){

        $avatar = $this->request->getFile('file'); //a
        $kunci = $this->request->getPost('kunci');
        $path = 'assets/users/'.$kunci;
        
        //folder e
        if(!file_exists($path)){
        	$create = mkdir('assets/users/'.$kunci, 0777,true);
        }

        //nama file e
        for($i=1;$i<=10;$i++){
        	$pathName = 'assets/users/'.$kunci.'/album'.$i.'.png';
        	if(!file_exists($pathName)){
        		$ok = array("no"=>$i,"kunci"=>$kunci);
        		$avatar->move('assets/users/'.$kunci, 'album'.$i.'.png');
                echo json_encode($ok);
                
                //save to db
                $dataAlbum = [
                    'id_user' => $_SESSION['id'],
                    'album' => 'album'.$i
  
                ];
                $saveAlbum = $this->DashboardModel->save_album($dataAlbum);
        		break;
        	} 
        }

       
    }

    public function do_del_gallery(){

       $id = $this->request->getPost('id');
       $kunci = $this->request->getPost('kunci');
       $file = 'assets/users/'.$kunci.'/album'.$id.'.png';
       unlink($file);
       $data['album'] = 'album'.$id;
       $data['id_user'] = $_SESSION['id'];
       $delete = $this->DashboardModel->delete_album($data);
       echo json_encode("sukses");
    }

    public function cerita(){

        $data['cerita'] = $this->DashboardModel->get_cerita_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Data Cerita';
        $data['view'] = 'base/dashboard/cerita';
		return view('base/dashboard/layout', $data);
    }

    public function do_update_cerita(){

            //HAPUS DULU SESSION SEBELUMNYA
            $jml_cerita_sebelumnya = $this->session->get('jml_cerita');

            for($i=0;$i<=$jml_cerita_sebelumnya;$i++){
                $this->session->remove('tanggal_cerita'.$i);
                $this->session->remove('judul_cerita'.$i);
                $this->session->remove('isi_cerita'.$i);
            }

            //SEBAGAI ARRAY PENANDA
            $noTanggal = 0;
			$noJudul = 0;
			$noIsi = 0;
            
            //KITA KUMPULKAN DAN SIMPAN DATANYA DI SESSION DULU
			foreach ($this->request->getPost('tanggal_cerita') as $value) {
                if($value == "")
                    continue;
                $this->session->set('tanggal_cerita'.$noTanggal++, $value); 
                
			}

			foreach ($this->request->getPost('judul_cerita') as $value) {
                if($value == "")
                continue;
                $this->session->set('judul_cerita'.$noJudul++, $value); 
			}

			foreach ($this->request->getPost('isi_cerita') as $value) {
                if($value == "")
                continue;
                $this->session->set('isi_cerita'.$noIsi++, $value); 
            }
            
            //KEMUDIAN HAPUS SEMUA DATA CERITA SEBULUMNYA
            $hpscerita = $this->DashboardModel->hapus_cerita();

            //SETELAH ITU KITA SIMPAN KE DB
            for($i=0;$i<$noTanggal;$i++){
				$tanggal_cerita = $this->session->get('tanggal_cerita'.$i);
				$judul_cerita = $this->session->get('judul_cerita'.$i);
				$isi_cerita = $this->session->get('isi_cerita'.$i);

				$dataCerita = [
					'id_user' => $_SESSION['id'],
					'tanggal_cerita' => $tanggal_cerita,
					'judul_cerita' => $judul_cerita,
					'isi_cerita' => $isi_cerita
				];

                $saveCerita = $this->DashboardModel->save_cerita($dataCerita);
            }

            return redirect()->to(base_url('user/cerita'));

    }

    public function invoice(){

        $data['pembayaran'] = $this->DashboardModel->get_pembayaran_by_id_user();
        $data['user'] = $this->DashboardModel->get_user_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['setting'] = $this->DashboardModel->get_setting();
        $data['title'] = 'Pembayaran';
        $data['view'] = 'base/dashboard/invoice';
		return view('base/dashboard/layout', $data);
    }

    public function profil(){

        $data['user'] = $this->DashboardModel->get_user_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Profil';
        $data['view'] = 'base/dashboard/profil';
		return view('base/dashboard/layout', $data);
    }

    public function do_update_user(){

        if($this->request->getPost('password') != ''){
            $data['password'] = md5($this->request->getPost('password'));
        }

        $data['username'] = $this->request->getPost('username');
        $data['email'] = $this->request->getPost('email');
        $data['hp'] = $this->request->getPost('hp');

        $update = $this->DashboardModel->update_user($data);
        if($update){
            $this->session->set('uname', $data['username']);
            echo 'sukses';
        }else{
            echo 'gagal';
        }
       
    }

    public function do_konfirmasi(){
        $bukti = $this->request->getFile('bukti');
        $invoice = $this->request->getPost('invoice');
        $dataPembayaran['nama_lengkap'] = $this->request->getPost('nama_lengkap');
        $dataPembayaran['nama_bank'] = $this->request->getPost('nama_bank');
        $dataPembayaran['status'] = '1'; //status menunggu konfirmasi atau user sudah upload bukti
        $dataPembayaran['bukti'] = $invoice.'.png';

        if (!$bukti->isValid())
        {
            return redirect()->to(base_url('user/invoice')); //jika bukti lebih dari 2 mb tolak
        }

         //folder e
         if(!file_exists('assets/bukti')){
        	$create = mkdir('assets/bukti', 0777,true);
        }

        $pathName = 'assets/bukti/'.$invoice.'.png';
        if(file_exists($pathName)){
            unlink($pathName);
        } 

        $bukti->move('assets/bukti/',$invoice.'.png'); //uploadd

        //setelah di upload insert data ke db
        $update = $this->DashboardModel->update_pembayaran($dataPembayaran,$invoice);
        if($update){
            return redirect()->to(base_url('user/invoice'));
        }else{
            return redirect()->to(base_url('user/invoice'));
        }

    }

}