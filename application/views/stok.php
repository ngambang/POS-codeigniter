<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="simpan_stok" method="post">
            <label>Nama Produk</label>
            <input type="text" required name="produk" class='form-control' onFocus="cari_produk_stok(this)" onKeypress="cari_produk_stok(this)">
            <input type="hidden" name="id" id='id_tambah' class='form-control' onFocus="cari_produk_stok(this)" onKeypress="cari_produk_stok(this)">
            <p></p>
            <label>Stok</label>
            <input type="number" name="stok" required id='jml' class="form-control">
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class='container'>
  
  <h4>Laporan Stok</h4>
  <div class='col-md-12'>
   <div class='row'>
    <div class="col-md-6">
            <div class="row">
                <input type="text" class="col-md-5 form-control date" onchange ="dari(this)" value="<?=$_SESSION['dari_stok']?>">
                <b class='col-md-2 text-center'>S/d</b>
                <input type="text" class="col-md-5 form-control date" onchange ="sampai(this)" value="<?=$_SESSION['sampai_stok']?>">
            </div>
        </div>  
        <div class="col-md-6">
            <button class='btn btn-primary' data-toggle="modal" data-target="#tambah">Tambah Stok</button>
        </div>

   </div>
    
  </div>
  
   <?php
    if($_SESSION['dari_stok'] > $_SESSION['sampai_stok']){
      echo '<div class="alert alert-danger mt-2 mb-0" role="alert">Masa iya tanggal depan lebih besar</div>';
    }
  ?>

  <div class="table-responsive ">
    <table class='table table-bordered mt-2'>
        <tr>
            <th>Nama Produk</th>
            <th>Stok Sebelum</th>
            <th>Stok Sesudah</th>
            <th>Keterangan</th>
            <th>Opr</th>
            <th>tgl Input</th>
        </tr> 
        <?php
        foreach ($stok as $key => $p) {
        ?>
            <tr>
                <td><?=$p['nama_produk']?></td>
                <td><?=$p['stok_sebelum']?></td>
                <td><?=$p['stok_sesudah']?></td>
                <td><b class="text-<?=(strpos($p['keterangan'],'Pengurangan') > 0)?'danger':'success'?>"><?=$p['keterangan']?></b></td>
                <td><?=$p['opr']?></td>
                <td><?=$p['tgl_log']?></td>
            </tr>

        <?php
        }
        ?>
    </table>

    <?=$page?> 

  </div>

</div>