<div class='container'>
  
  <h4>Laporan Penjualan</h4>
  <div class="col-md-6">
    <div class="row">
        <input type="text" class="col-md-5 form-control date" onchange ="dari(this)" value="<?=$_SESSION['dari_laporan']?>">
        <b class='col-md-2 text-center'>S/d</b>
        <input type="text" class="col-md-5 form-control date" onchange ="sampai(this)" value="<?=$_SESSION['sampai_laporan']?>">
    </div>
  </div>
   <?php
    if($_SESSION['dari_laporan'] > $_SESSION['sampai_laporan']){
      echo '<div class="alert alert-danger mt-2 mb-0" role="alert">Masa iya tanggal depan lebih besar</div>';
    }
   ?>

   <!-- Modal -->
   <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Penjualan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id='detail-penjualan'>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        </div>
      </div>
    </div>
   </div>


  <div class="table-responsive ">
    <table class='table table-bordered mt-2'>
        <tr>
            <th>Nama Produk</th>
            <th>Harga Jual</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Opr</th>
            <th>tgl Input</th>
            <th width='100'>Aksi</th>
        </tr>
        <?php
        foreach ($laporan as $key => $p) {
        ?>
            <tr>
                <td><?=$p['nama_produk']?></td>
                <td>Rp <?=number_format($p['harga_produk'],0,',','.')?></td>
                <td><?=$p['qty']?></td>
                <td>Rp <?=number_format($p['total'],0,',','.')?></td>
                <td><?=$p['opr']?></td>
                <td><?=$p['tgl_input']?></td>
                <td><button class="btn btn-primary" data-toggle="modal" data-target="#detail" onclick='detail_penjualan("<?=$p['grouping_penjualan']?>")'>Detail</button></td>
            </tr>

        <?php
        }
        ?>

    </table>

    <?=$page?> 

  <div class="col-md-12 p-0 mt-2">
        <table class="table table-bordered">
        <tr>
            <th>Total Penjualan</th>
            <th>Total Pembelian</th>
            <th>Total Potongan</th>
            <th>Total Bersih</th>
          </tr> 
          <tr>
            <td>Rp <?=number_format($laporanHasil[0]['total_jual'],0,',','.')?></td>
            <td>Rp <?=number_format($laporanHasil[0]['harga_beli'],0,',','.')?></td>
            <td>Rp <?=number_format($laporanPot[0]['total_potongan'],0,',','.')?></td>
            <td>Rp <?=number_format($laporanHasil[0]['total_jual']-$laporanHasil[0]['harga_beli']-$laporanHasil[0]['harga_beli'],0,',','.')?></td>

          </tr>
        </table>
    </div>
 
    
  
  </div>
 
</div>