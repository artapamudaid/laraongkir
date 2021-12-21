<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Checkout Page</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Halaman Checkout</h2>
            </div>
        </div>
        <form class="ps-checkout__form" action="" method="post">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <h3 class="mt-5 mb-5">Alamat Pengiriman</h3>
                    <div class="form-group ">
                        <label>Provinsi asal</label>
                        <input type="text" value="6" class="form-control" name="province_origin">
                    </div>
                    <div class="form-group ">
                        <label>Kota Asal</label>
                        <input type="text" value="40" class="form-control" id="city_origin" name="city_origin">
                    </div>
                    <div class="form-group ">
                        <label>Alamat<span>*</span>
                        </label>
                        <textarea name="address" class="form-control" rows="5"
                            placeholder="Alamat Lengkap pengiriman"></textarea>
                    </div>
                    <div class="form-group ">
                        <label>Provinsi Tujuan<span>*</span>
                        </label>
                        <select name="provinsi_id" id="provinsi_id" class="form-control">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinces as $list)
                            <option value="{{ $list['province_id'] }}" namaprovinsi="{{ $list['province'] }}">{{
                                $list['province'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" nama="nama_provinsi" id="nama_provinsi">
                    </div>
                    <div class="form-group ">
                        <label>Kota Tujuan<span>*</span>
                        </label>
                        <select name="kota_id" id="kota_id" class="form-control">
                            <option value="">Pilih Kota</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" nama="nama_kota" id="nama_kota">
                    </div>
                    <div class="form-group ">
                        <label>Kode Pos<span>*</span>
                        </label>
                        <input type="text" name="kode_pos" class="form-control">
                    </div>
                    <div class="form-group ">
                        <label>Pilih Ekspedisi<span>*</span>
                        </label>
                        <select name="kurir" id="kurir" class="form-control">
                            <option value="">Pilih Kurir</option>
                            <option value="jne">JNE</option>
                            <option value="tiki">TIKI</option>
                            <option value="pos">POS INDONESIA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Layanan<span>*</span>
                        </label>
                        <select name="layanan" id="layanan" class="form-control">
                            <option value="">Pilih Layanan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Total Belanja<span>*</span>
                        </label>
                        <input type="text" name="totalbelanja" id="totalbelanja" class="form-control"
                            value="{{ 50000 }}">
                    </div>
                    <div class="form-group ">
                        <label>Total Berat (gram) </label>
                        <input class="form-control" type="text" value="200" id="weight" name="weight">
                    </div>
                    <div class="form-group ">
                        <label>Total Ongkos kirim </label>
                        <input class="form-control" type="text" id="ongkos_kirim" name="ongkos_kirim">
                    </div>
                    <div class="form-group ">
                        <label>Total Keseluruhan </label>
                        <input class="form-control" type="text" id="total" name="total">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Proses Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function(){

            $('select[name="provinsi_id"]').on('change', function(){

                var namaprovinsiku = $("#provinsi_id option:selected").attr("namaprovinsi");
                $("#nama_provinsi").val(namaprovinsiku);

                let provinceid = $(this).val();

                if(provinceid){
                    jQuery.ajax({
                    url:"/get_city/"+provinceid,
                    type:'GET',
                    dataType:'json',
                    success:function(data){
                        $('select[name="kota_id"]').empty();
                        $.each(data, function(key, value){
                        $('select[name="kota_id"]').append('<option value="'+ value.city_id +'" namakota="'+ value.type +' ' +value.city_name+ '">' + value.type + ' ' + value.city_name + '</option>');
                        });
                    }
                    });
                } else {
                $('select[name="kota_id"]').empty();
                }
            });

            $('select[name="kota_id"]').on('change', function(){

                var namakotaku = $("#kota_id option:selected").attr("namakota");
                $("#nama_kota").val(namakotaku);

            });

            $('select[name="kurir"]').on('change', function(){
                let origin = $("input[name=city_origin]").val();
                let destination = $("select[name=kota_id]").val();
                let courier = $("select[name=kurir]").val();
                let weight = $("input[name=weight]").val();

                if(courier){
                    jQuery.ajax({
                        url:"/origin="+origin+"&destination="+destination+"&weight="+weight+"&courier="+courier,
                        type:'GET',
                        dataType:'json',
                        success:function(data){
                            $('select[name="layanan"]').empty();
                            $.each(data, function(key, value){
                            $.each(value.costs, function(key1, value1){
                            $.each(value1.cost, function(key2, value2){
                                $('select[name="layanan"]').append('<option value="'+ key +'" harga_ongkir="'+value2.value+'">' + value1.service + '-' +value2.value+ '</option>');
                            });
                            });
                            });
                        },
                    });
                } else {
                    $('select[name="layanan"]').empty();
                }
            });

            $('select[name="layanan"]').on('change', function(){
                let totalbelanja = $("input[name=totalbelanja]").val();
                var harga_ongkir = $("#layanan option:selected").attr("harga_ongkir");
                $("#ongkos_kirim").val(harga_ongkir);

                let total = parseInt(totalbelanja) + parseInt(harga_ongkir);
                $("#total").val(total);
            });

        });
    </script>
</body>

</html>