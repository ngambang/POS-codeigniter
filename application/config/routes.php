<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Toko';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//link utama
$route['login']             = 'Toko/login';
$route['home']              = 'Toko/home';
$route['produk']            = 'Toko/produk';
$route['produk/(:any)']     = 'Toko/produk/$1';
$route['laporan']           = 'Toko/laporan';
$route['laporan/(:any)']    = 'Toko/laporan/$1';
$route['keuangan']          = 'Toko/keuangan';
$route['stok']              = 'Toko/stok';
$route['stok/(:any)']       = 'Toko/stok/$1';
$route['logout']            = 'Toko/logout';

$route['simpan_kategori']   = 'Toko/simpan_kat';
$route['hapus_kategori']    = 'Toko/hapus_kat';

$route['tambah_produk']     = 'Toko/tambah_produk';
$route['ubah_produk']       = 'Toko/edit_produk';
$route['detail_produk']     = 'Toko/detail_produk';
$route['hapus_produk']      = 'Toko/hapus_produk';
$route['cari_produk']       = 'Toko/cari_produk';
$route['simpan_penjualan']  = 'Toko/simpan_penjualan';
$route['simpan_stok']       = 'Toko/simpan_stok';
$route['detail_penjualan']  = 'Toko/detail_penjualan';
