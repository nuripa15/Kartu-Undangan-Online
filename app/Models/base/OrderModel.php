<?php namespace App\Models\base;

use CodeIgniter\Model;

class OrderModel extends Model
{

	protected $acara,$cerita,$data,$komen,$maps,$mempelai,$order,$rules,$themes,$users,$album;

	public function __construct() {

        parent::__construct();
        $db      = \Config\Database::connect();
        $this->acara = $db->table('acara');
        $this->cerita = $db->table('cerita');
        $this->data = $db->table('data');
        $this->komen = $db->table('komen');
        $this->maps = $db->table('maps');
        $this->mempelai = $db->table('mempelai');
        $this->order = $db->table('order');
        $this->rules = $db->table('rules');
        $this->themes = $db->table('themes');
        $this->users = $db->table('users');
        $this->album = $db->table('album');
        $this->pembayaran = $db->table('pembayaran');

    }

    //untuk mengecek domain
    //dan mengambil domain sesuai dengan data(domain) yang dikirim
    public function cek_domain($domain)
    {
        return $this->order->where('domain', $domain)->get();
    }


    public function cek_themes($kode){
        return $this->themes->where('kode_theme', $kode)->get();
    }

    public function cek_order($kode){
    	$builder = $this->db->table('data');
		$builder->select('*,pembayaran.status as statusPembayaran, order.status as statusWeb');
		$builder->join('users', 'users.id = data.id_user', 'left');
		$builder->join('order', 'users.id = order.id_user', 'left');
		$builder->join('pembayaran', 'users.id = pembayaran.id_user', 'left');
		$builder->where('data.kunci', $kode);
    	return $builder->get();

    }

     public function cek_order_domain($domain){
        // $db  = \Config\Database::connect();
        $builder = $this->db->table('data');
        $builder->select('*');
        $builder->join('users', 'users.id = data.id_user', 'left');
        $builder->join('order', 'users.id = order.id_user', 'left');
        $builder->where('order.domain', $domain);
        return $builder->get();

    }

    public function update_kode($kode,$id){
        $builder = $this->db->table('users');
        $builder->set('id_unik',$kode);
        $builder->where('id',$id);
        return $builder->update();
    }

    public function cek_email($email)
    {
        return $this->users->where('email', $email)->get();
    }

    public function save_user($data){

    	return $this->users->insert($data);

    }

    public function save_mempelai($data){

    	return $this->mempelai->insert($data);

    }

    public function save_order($data){

    	return $this->order->insert($data);

    }

    public function save_acara($data){

    	return $this->acara->insert($data);

    }

    public function save_cerita($data){

    	return $this->cerita->insert($data);

    }

    public function save_album($data){

    	return $this->album->insert($data);

    }

    public function save_data($data){

    	return $this->data->insert($data);

    }


    public function save_rules($data){

    	return $this->rules->insert($data);

    }

    public function save_pembayaran($data){

    	return $this->pembayaran->insert($data);

    }

}
