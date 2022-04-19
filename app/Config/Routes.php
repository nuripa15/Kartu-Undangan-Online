<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

 /* =================== UNTUK SUB DOMAIN UNDANGAN ======================= */
if(isset($_SERVER['HTTP_HOST'])){
 if($_SERVER['HTTP_HOST'] == DOMAIN_UNDANGAN){

	$routes->setDefaultNamespace('App\Controllers\undangan');
	$routes->setDefaultController('Undangan');
	$routes->post('add_komentar', 'Undangan::do_add_komentar');
	$routes->add('(:any)', 'Undangan::Undangan');
	
/* =================== UNTUK ADMIN PANEL ======================= */		
}else if($_SERVER['HTTP_HOST'] == DOMAIN_ADMIN){

	$routes->setDefaultNamespace('App\Controllers\admin');
	$routes->setDefaultController('Admin');
	$routes->add('admin', 'Admin::dashboard');
	$routes->add('admin/dashboard', 'Admin::dashboard');
	$routes->add('admin/pembayaran', 'Admin::pembayaran');
	$routes->add('admin/profil', 'Admin::profil');
	$routes->add('admin/setting', 'Admin::setting');
	$routes->get('login', 'Admin::login');
	$routes->add('admin/edit_pengguna', 'Admin::edit_pengguna');

	$routes->add('logout', 'Admin::do_unauth');
	$routes->post('do_auth', 'Admin::do_auth');
	$routes->post('admin/update_setting', 'Admin::do_update_setting');
	$routes->post('admin/update_admin', 'Admin::do_update_admin');
	$routes->post('admin/konfirmasi', 'Admin::do_konfirmasi');
	$routes->post('admin/hapus_user', 'Admin::do_hapus_user');
	$routes->post('admin/update_fitur', 'Admin::do_update_fitur');
	$routes->post('admin/update_domain', 'Admin::do_update_domain');
	$routes->post('admin/update_foto_mempelai', 'Admin::do_update_foto_mempelai');
	$routes->post('admin/update_mempelai', 'Admin::do_update_mempelai');
	$routes->post('admin/update_acara', 'Admin::do_update_acara');
	$routes->post('admin/update_maps', 'Admin::do_update_maps');
	$routes->post('admin/update_gallery', 'Admin::do_update_gallery');
	$routes->post('admin/del_gallery', 'Admin::do_del_gallery');
	$routes->post('admin/update_cerita', 'Admin::do_update_cerita');
	$routes->post('admin/update_user', 'Admin::do_update_user');
	$routes->post('admin/update_musik', 'Admin::do_update_musik');
	$routes->post('admin/update_video', 'Admin::do_update_video');

/* =================== UNTUK DOMAIN UTAMA ======================= */	
}else{

	$routes->setDefaultNamespace('App\Controllers\base');
	$routes->setDefaultController('Beranda');

	//TUTORIAL
	$routes->add('youtube', 'Beranda::youtube');
	$routes->add('maps', 'Beranda::maps');
	
	//TEMA
	$routes->add('tema', 'Beranda::themes');

	//DEMO
	$routes->add('demo/(:any)', 'Beranda::demo');

	//ORDER
	$routes->add('order', 'Order');
	$routes->add('order/1', 'Order');
	$routes->add('order/2', 'Order::mempelai');
	$routes->add('order/3', 'Order::acara');
	$routes->add('order/4', 'Order::cerita');
	$routes->add('order/5', 'Order::gallery');
	$routes->add('order/del', 'Order::del');
	$routes->add('order/upload', 'Order::fileUpload');
	$routes->add('order/imgupload', 'Order::imgupload');
	$routes->add('order/save', 'Order::saveData');
	$routes->add('order/finish', 'Order::finish');
	$routes->add('order/success/(:any)', 'Order::success');
	$routes->add('order/any', 'Order::any');
	$routes->add('order/(:any)', 'Order');

	//DASHBOARD USER
	$routes->get('login', 'Dashboard::login');
	$routes->get('user/dashboard', 'Dashboard::index');
	$routes->get('user/riwayat', 'Dashboard::riwayat');
	$routes->get('user/ucapan', 'Dashboard::ucapan');
	$routes->get('user/tampilan', 'Dashboard::tampilan');
	$routes->get('user/pengaturan', 'Dashboard::pengaturan');
	$routes->get('user/mempelai', 'Dashboard::mempelai');
	$routes->get('user/acara', 'Dashboard::acara');
	$routes->get('user/album', 'Dashboard::gallery');
	$routes->get('user/cerita', 'Dashboard::cerita');
	$routes->get('user/invoice', 'Dashboard::invoice');
	$routes->get('user/profil', 'Dashboard::profil');
	$routes->get('user/logout', 'Dashboard::do_unauth');

	$routes->post('do_auth', 'Dashboard::do_auth');
	$routes->post('user/hapus_komentar', 'Dashboard::do_hapus_komentar');
	$routes->post('user/ganti_tema', 'Dashboard::do_ganti_tema');
	$routes->post('user/update_fitur', 'Dashboard::do_update_fitur');
	$routes->post('user/update_domain', 'Dashboard::do_update_domain');
	$routes->post('user/update_foto_mempelai', 'Dashboard::do_update_foto_mempelai');
	$routes->post('user/update_mempelai', 'Dashboard::do_update_mempelai');
	$routes->post('user/update_acara', 'Dashboard::do_update_acara');
	$routes->post('user/update_maps', 'Dashboard::do_update_maps');
	$routes->post('user/update_gallery', 'Dashboard::do_update_gallery');
	$routes->post('user/del_gallery', 'Dashboard::do_del_gallery');
	$routes->post('user/update_cerita', 'Dashboard::do_update_cerita');
	$routes->post('user/update_user', 'Dashboard::do_update_user');
	$routes->post('user/update_musik', 'Dashboard::do_update_musik');
	$routes->post('user/update_video', 'Dashboard::do_update_video');
	$routes->post('user/konfirmasi', 'Dashboard::do_konfirmasi');


	//REDIRECT SEMUA ROUTES TIDAK DIKENAL KE HOME
	$routes->add('(:any)', 'Beranda');

}
}





/* =================== DEFAULT ROUTES ======================= */	
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
// $routes->add('theme', 'Anu::demo');
// $routes->add('(:any)', 'Anu::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
