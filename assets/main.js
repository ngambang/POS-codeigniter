let penjualan_ke     = 0;
let jumlah_penjualan = 1;

$( ".date" ).datepicker({ dateFormat: 'yy-mm-dd' });

//simpan kategori
function simpan_kategori(){

    var nama = $('#tambah_nama_kategori').val();
    if(nama !== '' & nama.length > 1){
          
        $.post(urlUtama + 'simpan_kategori',JSON.stringify({'nama':nama}), function( hasil ) {
            console.log(hasil);
            data     = JSON.parse(hasil);
            var html = '';

            // jika tidak ada error
            if(data['error'] == 0){

                html += `
                          <tr id='tr-${data['id']}'>
                            <td>${data['nama']}</td>
                            <td><a href='#' data-id='${data['id']}' onclick='hapus_kategori(this)' class='btn btn-danger'>Hapus</a></td>
                          </tr> 
                        `;

                $('#tampung-kategori').prepend(html);
                $('input[type=text]').val('')
            }
            


        });

    }else{

        alert('Nama kategori kosong/kurang dari 1 Huruf');
        
        $('#tambah_nama_kategori').focus()

    }


    return false;

}

//hapus kategori
function hapus_kategori(e){
    
    var id = $(e).data('id');

    if(confirm("Apakah anda yakin?")){

        $.get(urlUtama + "hapus_kategori?idHps="+id,function (data) {
            $('#tr-'+id).remove()

        })

    } 

    return 0;

}

//ubah produk
function ubah_produk(e){
   
    $.get(urlUtama + "detail_produk?id=" + $(e).data('id'), function(data){
        var rs = JSON.parse(data);
        console.log(rs['data'][0]);
        $('#u-id').val(rs['data'][0]['id_produk']);
        $('#u-namaProduk').val(rs['data'][0]['nama_produk']);
        $('#u-kodeBarcode').val(rs['data'][0]['kode_barcode']);
        $('#u-kategori').val(rs['data'][0]['kategori']);
        $('#u-jmlStok').val(rs['data'][0]['stok']);
        $('#u-hrgBeli').val(rs['data'][0]['harga_beli']);
        $('#u-hrgJual').val(rs['data'][0]['harga_jual']);
        $('#u-catatan').val(rs['data'][0]['catatan']);

    })

}

//event tutup modal 
$('.modal').on('hidden.bs.modal', function (e) {

    location.reload(); 

})

//tambah kolom penjualan
function tambah_penjualan(){

    penjualan_ke++;
    jumlah_penjualan++;

    html = ` <div class="form-group row" id="jual-${penjualan_ke}">
            
                <div class="col-sm-5 mt-1">
                    <input type="text" class="form-control" data-id="${penjualan_ke}" onKeypress="cari_produk(this)" id="input-produk-${penjualan_ke}" name="produk[]" placeholder="Produk">
                    <input type="hidden" id='input-id-${penjualan_ke}' name='id[]'>
                    <input type="hidden" id='hpp-${penjualan_ke}' name='hpp[]'>

                </div>

                <div class="col-md-5">
    
                    <div class="row">

                        <div class="col-4 mt-1 pr-0">
                         <input type="number" class="form-control" id="harga-jual-${penjualan_ke}" name="harga[]" placeholder="harga ">
                        </div>

                        <div class="col-4 mt-1">
                            <input type="number" min="1" value='1' class="form-control" onKeypress="hitungTotal(this)" onFocus="hitungTotal(this)" onKeydown="hitungTotal(this)" onKeyup="hitungTotal(this)" id="jml-${penjualan_ke}" name="jml[]" placeholder="Jml">
                        </div>

                        <div class="col-4 mt-1 pl-0">
                            <input type="number" class="form-control" id="total-${penjualan_ke}" name="total[]" placeholder="Total ">
                        </div>

                    
                    </div>
                
                </div>

                <div class="col-md-2 mt-1">
                    
                    <div class="row">
                        <div class="col-6 pr-1">
                            <button type="button" class="btn btn-primary btn-block" onclick="tambah_penjualan()">+</button>
                        </div>
                        
                        <div class="col-6 pl-1"> 
                           <button type="button" class="btn btn-danger btn-block" onclick="hapus_penjualan(${penjualan_ke})">-</button>
                        </div>
             
                    </div>
                </div>
            </div>
            `;

    $("#penjualan").append(html);
    $("#jml-penjualan").html(jumlah_penjualan);
    
}

//hapus kolom penjualan sesuai urutannya
function hapus_penjualan(n){
    
    jumlah_penjualan--;
    $("#jml-penjualan").html(jumlah_penjualan);
    $("#jual-"+n).remove();

    total_penjualan();

}

//autocomplate penjualan
function cari_produk(e){
 
    var idInput = e.id;    
    var inputKe = e.dataset.id;

      $('input#'+idInput).autocomplete({
        source: function( request, response ) {
            $.ajax( {
              url: urlUtama+"cari_produk?c=" + e.value,
              dataType: "json",
              data: {
                term: request.term
              },
              success: function( data ) {
                response( data );
                console.log(data)
                if(data.length == 1){
                   
                    if(data[0]['bc'] == 1){

                        var nama_produk = data[0]['value'];
                        var harga       = data[0]['harga'];
                        var id          = data[0]['id'];
                        var hpp         = data[0]['hpp'];
                        
                        $("#"+idInput).val(nama_produk);
                        $("#harga-jual-"+inputKe).val(harga);
                        $("#input-id-"+inputKe).val(id);
                        $("#hpp-"+inputKe).val(hpp);
                        $('input#'+idInput).autocomplete( "close" );
                        $("#total-"+inputKe).val(harga);
                        total_penjualan();

                        $("#jml-"+inputKe).focus();
                    }                   
                
                }
              }
            });
        },
        minLength: 0,
        select: function (event, ui) {
            
           //store in session
           var nama_produk = ui.item.value;
           var harga       = ui.item.harga;
           var id          = ui.item.id;
           var hpp         = ui.item.hpp;

           $("#"+idInput).val(nama_produk);
           $("#harga-jual-"+inputKe).val(harga);
           $("#input-id-"+inputKe).val(id);
           $("#total-"+inputKe).val(harga);
           $("#hpp-"+inputKe).val(hpp);

         
           total_penjualan();  
           $("#jml-"+inputKe).focus();
        }
      });
                                                 
}                                                                                                                                           

//hitung total pernjualan
function hitungTotal(e){
    var ambil_id   = e.id.split('-')[1];
    var harga_jual = $("#harga-jual-"+ambil_id).val();

    if(e.value == '' || e.value == undefined){

        e.value =1;

    }

    var total      = e.value*harga_jual;
    $("#total-"+ambil_id).val(total)
    
    total_penjualan();
}

//hitung total semua
function total_penjualan(){
    var jumlah  = 0;
    var dibayar = $('#jumlah_uang').val();

    if($("#potongan").val() == ''){
        
        $("#potongan").val(0)

    }

    for(i=0;i<=penjualan_ke;i++){

        if($("#total-"+i).val()){
            jumlah = jumlah+parseInt($("#total-"+i).val())-parseInt($("#potongan").val());

        }

    }
    
    $("#total_bayar").val(jumlah);
    var kembalian = (parseInt(dibayar-jumlah) < 1)?0:parseInt(dibayar-jumlah);

    $("#kembalian").val(kembalian);
}

//filter tanggal laporan
function dari(e){

    window.location="?dari="+$(e).val();

}

//filter tanggal laporan
function sampai(e){

    window.location="?sampai="+$(e).val();

}

//
function cari_produk_stok(e){
 

      $(e).autocomplete({
        source: function( request, response ) {
            $.ajax( {
              url: urlUtama+"cari_produk?c=" + e.value,
              dataType: "json",
              data: {
                term: request.term
              },
              success: function( data ) {
                response( data );
                if(data.length == 1){
                    
                    var nama_produk = data[0]['value'];
                    var id          = data[0]['id'];
                    $(e).val(nama_produk);
                    $('#id_tambah').val(id);

                    $('#jml').focus();
                }
              }
            });
        },
        minLength: 0,
        select: function (event, ui) {

            var nama_produk = ui.item.value;
            var id          = ui.item.id;
            $(e).val(nama_produk);
            $('#id_tambah').val(id);

            $('#jml').focus();
         
        }
      });
                                                 
} 

//kategori produk
function pilih_kategori(e){
    
    window.location="?kategori="+$(e).val();

}

//detail
function detail_penjualan(e){
    
    $.get(urlUtama+'detail_penjualan?id='+e,function(data){
        console.log(data);
        $("#detail-penjualan").html(data)
    })

}