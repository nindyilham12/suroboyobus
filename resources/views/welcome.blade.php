@extends('/layouts/sidebar')
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9wpdoXipOnUsg4ucjOsRNFkkUPYyMK48&sensor=false" type="text/javascript"></script>
    <script>
        var marker;
        function initialize() {

       // Variabel untuk menyimpan informasi (desc)
        var infoWindow = new google.maps.InfoWindow;
        //  Variabel untuk menyimpan peta Roadmap
        var mapOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP
        } 
        // Pembuatan petanya
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        // Variabel untuk menyimpan batas kordinat
        var bounds = new google.maps.LatLngBounds();

        //Pengambilan data dari database
        <?php
            if($data->count()>0){
              foreach($data as $d){
                $nama = $d['nama_banksampah'];
                $lat = $d['latitude'];
                $lng = $d['longtitude'];
                echo ("addMarker($lat, $lng, 'Lokasi :$nama<br/>Latitude : $lat<br/>Longitude : $lng');");  
              }
          }
        ?>

        // Proses membuat marker 
        function addMarker(lat, lng, info) {
            var lokasi = new google.maps.LatLng(lat, lng);
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
                map: map,
                position: lokasi
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
         }

        // Menampilkan informasi pada masing-masing marker yang diklik
            function bindInfoWindow(marker, map, infoWindow, html) {
                google.maps.event.addListener(marker, 'click', function() {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                });
            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

@section('content')
    <section class="main-section">
    <br>
    <div class="panel panel-container">
        <div class="row">
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-teal panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-map-marker color-blue"></em>
                        <div class="large"><?php echo count($data);?></div>
                        <div class="text-muted">Bank Sampah</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-blue panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-bus color-orange"></em>
                        <div class="large"><?php echo count($jml_bus);?></div>
                            <div class="text-muted">Suroboyo Bus</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-teal panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-trash color-blue"></em>
                        <div class="large"><?php $jml_sampah = 0;
                                                foreach($data as $item=>$value){
                                                    $jml_sampah +=$value['sampah_banksampah'];
                                                } echo "".$jml_sampah;?></div>
                        <div class="text-muted">Sampah Botol</div>
                    </div>
                </div>
            </div>
             <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-orange panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-user color-teal"></em>
                        <div class="large"><?php echo count($user);?></div>
                            <div class="text-muted">Jumlah User</div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
   
</section>
    <div id="map" style="width:1100px;height:500px;"></div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h3>Suroboyo Bus</h3>
                <p>Dinas Perhubungan Kota Surabaya</p>
                <p>Bawa Sampah Plastik, Siap Antar Keliling Kota Surabaya</p>
                <a href= "http://dishub.surabaya.go.id/">dishub.surabaya.go.id</a>
            </div>
            <div class="col-sm-6">
                <h3>Bank Sampah Surabaya</h3>
                <p>Dinas Kebersihan dan Ruang Terbuka Hijau Kota Surabaya</p>
                <p>Kartu Setor Sampah Plastik, Naik Suroboyo Bus</p>
                <a href= "http://dkp.surabaya.go.id/">dkp.surabaya.go.id</a>
            </div>
        </div>
    </div>

@endsection
