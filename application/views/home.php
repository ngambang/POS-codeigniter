<div class="container">
    <h4>Input Penjualan (<b id='jml-penjualan'>1</b> <b> Produk</b> ) </h4>
    <hr>
    <form action="<?=base_url('simpan_penjualan')?>" method="post" onkeydown="return event.key != 'Enter';">
        <div class="form-group row" id="jual-0">
            
            <div class="col-md-5 mt-1">
             <input type="text" class="form-control" onFocus="cari_produk(this)" onKeypress="cari_produk(this)" data-id="0" id="input-produk-0" name="produk[]" placeholder="Produk">
             <input type="hidden" id='input-id-0' name='id[]'>
             <input type="hidden" id='hpp-0' name='hpp[]'>
            </div>

            <div class="col-md-5">
 
                <div class="row">

                <div class="col-4 mt-1 pr-0">
                  <input type="number" class="form-control" id="harga-jual-0" name="harga[]" placeholder="harga ">
                </div>

                <div class="col-4 mt-1">
                    <input type="number" class="form-control" min="1" value='1' onKeypress="hitungTotal(this)" onFocus="hitungTotal(this)" onKeydown="hitungTotal(this)" onKeyup="hitungTotal(this)" id="jml-0" name="jml[]" placeholder="Jml">
                </div>

                <div class="col-4 mt-1 pl-0">
                    <input type="number" class="form-control" id="total-0" name="total[]" placeholder="Total ">
                </div>

               
                </div>
            
            </div>
            
            <div class="col-md-2 mt-1">
                 <button type="button" class="btn btn-primary col-md-12" onclick="tambah_penjualan()">+</button>
            </div>    

        </div>

        <div id="penjualan">
        </div>

        <hr>
        <div class="col-md-12 p-0">

            <div class="row">

                <div class="col-md-3">
                  <b>Total yg Dibayar</b>
                  <input type="number" name='total_bayar' id='total_bayar' class='form-control'>
                </div>
                <div class="col-md-3">
                  <b>Potongan</b>
                  <input type="number" min=0 onkeydown="total_penjualan()" onkeyup="total_penjualan()" onkeypress="total_penjualan()" name='potongan' value='0' id='potongan' class='form-control'>
                </div>
                <div class="col-md-3">
                  <b>Jumlah Uang</b>
                  <input type="number" name='jumlah_uang' onkeydown="total_penjualan()" onkeyup="total_penjualan()" onkeypress="total_penjualan()" id='jumlah_uang' value='0' min='0' class='form-control'>
                </div>
                <div class="col-md-3">
                  <b>Uang Kembali</b>
                  <input type="number" name='kembalian' id='kembalian' class='form-control'>
                </div>

                <div class="col-md-12 mt-2">
                  <b>Catatan (optional)</b>
                  <textarea name="ctt" class='form-control'></textarea>
                </div>

 
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-2">Simpan</button>

    </form>
</div>