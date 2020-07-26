<div class='container'>
  
  <h4>Data Produk <b title="Harga beli*stok">(Rp <?=isset($total_uang[0]['total_uang'])?number_format($total_uang[0]['total_uang'],0,',','.'):0?>)</b></h4>

  <button class='btn btn-primary' data-toggle="modal" data-target="#tambah-produk">Tambah Produk</button>
  <button class='btn btn-success' data-toggle="modal" data-target="#tambah-kategori">Tambah Kategori</button>
  <select class='ml-1 btn ' onchange='pilih_kategori(this)'>
    <option value='null' <?=($_SESSION['kategori'] == 'null')?'selected':''?>>Default</option>
    <?php

       foreach ($kategori['data'] as $ktg) {
          $se = ($_SESSION['kategori'] == $ktg['id_kategori'])?'selected':'';
           echo "<option value='{$ktg['id_kategori']}' {$se}>{$ktg['nama_kategori']}</option>";
       }

    ?>
  </select>    

 
  <!-- Modal tambah produk -->
  <div class="modal fade" id="tambah-produk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="<?=base_url()?>tambah_produk" method="post">
                
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" required class="form-control" id="namaProduk" name="namaProduk" placeholder="Masukan Nama Produk">
                </div> 

                <div class="form-group">
                    <label>Kode Barcode</label>
                    <input type="text" class="form-control" id="kodeBarcode" name="kodeBarcode" placeholder="Kode Barcode">
                    <small class="form-text text-muted">Boleh dikosongi</small>
                </div> 

                <div class="form-group">
                    <label>Kategori</label>
                    <select class='form-control' name='kategori'>
                        <?php

                            foreach ($kategori['data'] as $ktg) {

                                echo "<option value='{$ktg['id_kategori']}'>{$ktg['nama_kategori']}</option>";
                            }

                        ?>
                    </select>    
                </div> 
                
                <div class="form-group">
                    <label>Jumlah Stok</label>
                    <input type="number" required class="form-control" id="jmlStok" name="jmlStok" placeholder="Stok Sekarang">
                </div> 

                <div class="form-group">
                    <label>Hrg Beli</label>
                    <input type="number" required class="form-control" id="hrgBeli" name="hrgBeli" placeholder="Harga Beli">
                </div> 

                <div class="form-group">
                    <label>Hrg Jual</label>
                    <input type="number" required class="form-control" id="hrgJual" name="hrgJual" placeholder="Harga Beli">
                </div> 

                <div class="form-group">
                    <label>Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" placeholder="Catatan Untuk Produk Ini"></textarea>
                    <small class="form-text text-muted">Boleh dikosongi</small>
                    
                </div> 

                
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Produk</button>
            </form>
        </div>
        </div>
    </div>
  </div>

  <!-- Modal ubah produk -->
  <div class="modal fade" id="ubah-produk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="<?=base_url()?>ubah_produk" method="post">
                <input type='hidden' name='id' id='u-id'>
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" required class="form-control" id="u-namaProduk" name="namaProduk" placeholder="Masukan Nama Produk">
                </div> 

                <div class="form-group">
                    <label>Kode Barcode</label>
                    <input type="text" class="form-control" id="u-kodeBarcode" name="kodeBarcode" placeholder="Kode Barcode">
                    <small class="form-text text-muted">Boleh dikosongi</small>
                </div> 

                <div class="form-group">
                    <label>Kategori</label>
                    <select class='form-control' name='kategori' id='u-kategori'>
                        <?php

                            foreach ($kategori['data'] as $ktg) {

                                echo "<option value='{$ktg['id_kategori']}'>{$ktg['nama_kategori']}</option>";
                            }

                        ?>
                    </select>    
                </div> 
                
                <div class="form-group">
                    <label>Jumlah Stok</label>
                    <input type="number" required class="form-control" id="u-jmlStok" name="jmlStok" placeholder="Stok Sekarang">
                </div> 

                <div class="form-group">
                    <label>Hrg Beli</label>
                    <input type="number" required class="form-control" id="u-hrgBeli" name="hrgBeli" placeholder="Harga Beli">
                </div> 

                <div class="form-group">
                    <label>Hrg Jual</label>
                    <input type="number" required class="form-control" id="u-hrgJual" name="hrgJual" placeholder="Harga Beli">
                </div> 

                <div class="form-group">
                    <label>Catatan</label>
                    <textarea class="form-control" id="u-catatan" name="catatan" placeholder="Catatan Untuk Produk Ini"></textarea>
                    <small class="form-text text-muted">Boleh dikosongi</small>
                    
                </div> 

                

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Ubah Produk</button>
            </form>
        </div>
        </div>
    </div>
  </div>

  <!-- Modal tambah kategori -->
  <div class="modal fade" id="tambah-kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class='row' onSubmit='return simpan_kategori()'> 
                  
                  <div class='col-md-9'>
                     <input type='text' name='nama_kategori' id='tambah_nama_kategori' placeholder='Kategori Baru' class='form-control'>
                  </div>

                  <div class='col-md-2'>
                     <input type='submit' name='kategori' class='btn btn-primary' value='Tambah'>
                  </div>

                </form>

                <table class='mt-2 table table-bordered'>
                    
                    <tr>
                        <th>Nama Kategori</th>
                        <th width='20px'>Aksi</th>
                    </tr>
                    
                    <tbody id='tampung-kategori'>
                    <?php

                        foreach ($kategori['data'] as $ktg) {

                            echo "
                                    <tr id='tr-{$ktg['id_kategori']}'>
                                        <td>{$ktg['nama_kategori']}</td>
                                        <td><a href='#' onclick='hapus_kategori(this)' data-id='{$ktg['id_kategori']}' class='btn btn-danger'>Hapus</a></td>
                                    </tr>
                                 ";

                        }

                    ?>
                    </tbody>

                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
  </div>



  <div class="table-responsive ">
    <table class='table table-bordered mt-2'>
        <tr>
            <th>Nama Produk</th>
            <th>Barcode</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Hrg Beli</th>
            <th>Hrg Jual </th>
            <th width='140'>Aksi</th>
        </tr>
        <?php
        foreach ($produk as $key => $p) {
            
            $hrg_beli = ($p['harga_beli']!=='')?number_format($p['harga_beli'],0,',','.'):0;
            $hrg_jual = ($p['harga_jual']!=='')?number_format($p['harga_jual'],0,',','.'):0;
            echo "<tr>";
                echo "<td>{$p['nama_produk']}</td>";
                echo "<td>{$p['kode_barcode']}</td>";
                echo "<td>{$p['nama_kategori']}</td>";
                echo "<td>{$p['stok']}</td>";
                echo "<td>Rp, ".$hrg_beli."</td>";
                echo "<td>Rp, ".$hrg_jual."</td>";
                echo "<td>
                        <button class='btn btn-success mt-1' onclick='ubah_produk(this)' data-toggle='modal' data-target='#ubah-produk' data-id='".$p['id_produk']."'/><i class='fas fa-user-edit'></i></button>
                        <a href='".base_url('hapus_produk')."?id={$p['id_produk']}' onclick='return confirm(\"Anda yakin????\")' class='btn btn-danger mt-1'><i class='fas fa-user-minus'></i></a>
                    </td>";
            echo "</tr>";
        }
        ?>

    </table>

    <?=$page?> 
    
  
  </div>
 
</div>