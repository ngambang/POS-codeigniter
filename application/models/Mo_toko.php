<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_toko extends CI_model {

    //ambil semua data
    function getAll($table,$order = null){

       if($order !== null){

         $this->db->order_by($order);

       }

       $query  = $this->db->get($table);
       return array('data' => $query->result_array(),'row'=>$query->num_rows());

    }

    function getWhere($table, $where = null, $like = null,$limit = null){

        if($where!==null){

            $this->db->where($where);

        }

        if($limit!==null){

            $this->db->limit($limit);

        }
        

        if($like!==null){

            $this->db->where($like);

        }

       $query  = $this->db->get($table);
       return array('data'=>$query->result_array(),'row'=>$query->num_rows());
       
    }

    function insert($table,$data){

        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }

    function update($table, $data, $where){

        $this->db->where($where);
        $this->db->update($table,$data);


    }
    
    public function hapus($table,$where){

		$this->db->where($where);
		$this->db->delete($table);

    }
    
    function produkall($limit, $start ,$cari = null){

        if($cari!==null){

            $this->db->where($cari);

        }
        if($_SESSION['kategori'] !== 'null'){
            
            $this->db->where('data_produk.kategori',$_SESSION['kategori']);

        }
        $this->db->join("kategori","data_produk.kategori = kategori.id_kategori","left");  
        $this->db->order_by("id_produk desc");  
        $query = $this->db->get('data_produk', $limit, $start);
        return $query->result_array();
    }

    function produkPaging($cari = null){

        if($cari!==null){

            $this->db->where($cari);

        }
        if($_SESSION['kategori'] !== 'null'){
            
            $this->db->where('data_produk.kategori',$_SESSION['kategori']);

        }
        $this->db->join("kategori","data_produk.kategori = kategori.id_kategori","left");  
        $this->db->order_by("id_produk desc");  
        $query = $this->db->get('data_produk');
        return $query->num_rows();
    }

    function laporanall($limit, $start ,$cari = null){

        if($cari!==null){

            $this->db->where($cari);

        }

        $date_sekarang = $_SESSION['sampai_laporan'];
        $date1 = str_replace('-', '/', $date_sekarang);
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));

        $this->db->where('tgl_input >=', $_SESSION['dari_laporan']);
        $this->db->where('tgl_input <=', $tomorrow);

        $this->db->join("data_produk","data_produk.id_produk = penjualan_peritem.id_produk");  
        $this->db->order_by("id_penjualan desc");  
        $query = $this->db->get('penjualan_peritem', $limit, $start);
        return $query->result_array();

    }

    function laporanPaging($cari = null){

        if($cari!==null){
            $this->db->where($cari);
        }

        $date_sekarang = $_SESSION['sampai_laporan'];
        $date1 = str_replace('-', '/', $date_sekarang);
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));

        $this->db->where('tgl_input >=', $_SESSION['dari_laporan']);
        $this->db->where('tgl_input <=', $tomorrow);


        $this->db->join("data_produk","data_produk.id_produk = penjualan_peritem.id_produk");  
        $this->db->order_by("id_penjualan desc");  
        $query = $this->db->get('penjualan_peritem');
        return $query->num_rows();
    }

    function hitungLaporan(){

        // $this->db->select();
        $date_sekarang = $_SESSION['sampai_laporan'];
        $date1 = str_replace('-', '/', $date_sekarang);
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));

        $this->db->select("sum(`total`) as total_jual,sum(`hpp`*`qty`) as harga_beli");
        $this->db->from("penjualan_peritem");
        $this->db->where('tgl_input >=', $_SESSION['dari_laporan']);
        $this->db->where('tgl_input <=', $tomorrow);
        $query = $this->db->get();
        return $query->result_array();

    }

    function hitungDataProduk(){

        // $this->db->select();

        $this->db->select("sum(`harga_beli`*`stok`) as total_uang");
        $this->db->from("data_produk");
        $query = $this->db->get();
        return $query->result_array();

    }


    function hitungPotongan(){

        // $this->db->select();
        $date_sekarang = $_SESSION['sampai_laporan'];
        $date1 = str_replace('-', '/', $date_sekarang);
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));

        $this->db->select("sum(`potongan`) as total_potongan");
        $this->db->from("grouping_penjualan");
        $this->db->where('tgl_input >=', $_SESSION['dari_laporan']);
        $this->db->where('tgl_input <=', $tomorrow);
        $query = $this->db->get();
        return $query->result_array();

    }

    function stokall($limit, $start ,$cari = null){

        if($cari!==null){

            $this->db->where($cari);

        }

        $date_sekarang = $_SESSION['sampai_stok'];
        $date1 = str_replace('-', '/', $date_sekarang);
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
        $this->db->select("*,log_stok.tgl_up as tgl_log");
        $this->db->where('log_stok.tgl_up >=', $_SESSION['dari_stok']);
        $this->db->where('log_stok.tgl_up <=', $tomorrow);

        $this->db->join("data_produk","data_produk.id_produk = log_stok.id_produk");  
        $this->db->order_by("log_stok.tgl_up desc");  
        $query = $this->db->get('log_stok', $limit, $start);
        return $query->result_array();
        
    }

    function stokPaging($cari = null){

        if($cari!==null){
            $this->db->where($cari);
        }

        $date_sekarang = $_SESSION['sampai_stok'];
        $date1 = str_replace('-', '/', $date_sekarang);
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));

        $this->db->where('log_stok.tgl_up >=', $_SESSION['dari_stok']);
        $this->db->where('log_stok.tgl_up <=', $tomorrow);

        $this->db->join("data_produk","data_produk.id_produk = log_stok.id_produk");  
        $this->db->order_by("no_lstok desc");  
        $query = $this->db->get('log_stok');
        return $query->num_rows();
    }

    function detail_penjualan($id){

        $this->db->where('grouping_penjualan',$id);
        $this->db->join('data_produk',"data_produk.id_produk = penjualan_peritem.id_produk");
        $query = $this->db->get('penjualan_peritem');
        return array('data'=>$query->result_array(),'row'=>$query->num_rows());

    }

  
}