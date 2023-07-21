@extends('/layouts/sidebar')
<head>
    <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyC9wpdoXipOnUsg4ucjOsRNFkkUPYyMK48
" type="text/javascript"></script>
    <script>
    var iterations=0;
    function load() {
        if(typeof GBrowserIsCompatible === 'undefined'){
            setTimeout (load, 1000);
            iterations++;
        }
        else{
            if (GBrowserIsCompatible()) {
                var map = new GMap2(document.getElementById("map"));
                map.addControl(new GSmallMapControl());
                map.addControl(new GMapTypeControl());

                var center = new GLatLng(-7.250445, 112.768845);
                map.setCenter(center, 13);
                geocoder = new GClientGeocoder();

                var marker = new GMarker(center, {draggable: true});  
                map.addOverlay(marker);
                document.getElementById("lat").value = center.lat().toFixed(5);
                document.getElementById("lng").value = center.lng().toFixed(5);

                GEvent.addListener(marker, "dragend", function() {
                    var point = marker.getPoint();
                    map.panTo(point);
                    document.getElementById("lat").value = point.lat().toFixed(5);
                    document.getElementById("lng").value = point.lng().toFixed(5);
                });

                GEvent.addListener(map, "moveend", function() {
                    map.clearOverlays();
                    var center = map.getCenter();
                    var marker = new GMarker(center, {draggable: true});
                    map.addOverlay(marker);
                    document.getElementById("lat").value = center.lat().toFixed(5);
                    document.getElementById("lng").value = center.lng().toFixed(5);

                    GEvent.addListener(marker, "dragend", function() {
                        var point =marker.getPoint();
                        map.panTo(point);
                        document.getElementById("lat").value = point.lat().toFixed(5);
                        document.getElementById("lng").value = point.lng().toFixed(5);
                    });
                });

            }else{
                alert('browser is not supported');
            }
        }
    }

    function showAddress(address) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());

        if (geocoder) {
            geocoder.getLatLng(
                address,
                function(point) {
                    if (!point) {
                        alert(address + " not found");
                    } else {
                        document.getElementById("lat").value = point.lat().toFixed(5);
                        document.getElementById("lng").value = point.lng().toFixed(5);
                        map.clearOverlays()
                        map.setCenter(point, 14);
                        var marker = new GMarker(point, {draggable: true});  
                        map.addOverlay(marker);

                        GEvent.addListener(marker, "dragend", function() {
                            var pt = marker.getPoint();
                            map.panTo(pt);
                            document.getElementById("lat").value = pt.lat().toFixed(5);
                            document.getElementById("lng").value = pt.lng().toFixed(5);
                        });

                        GEvent.addListener(map, "moveend", function() {
                            map.clearOverlays();
                            var center = map.getCenter();
                            var marker = new GMarker(center, {draggable: true});
                            map.addOverlay(marker);
                            document.getElementById("lat").value = center.lat().toFixed(5);
                            document.getElementById("lng").value = center.lng().toFixed(5);

                            GEvent.addListener(marker, "dragend", function() {
                                var pt = marker.getPoint();
                                map.panTo(pt);
                                document.getElementById("lat").value = pt.lat().toFixed(5);
                                document.getElementById("lng").value = pt.lng().toFixed(5);
                            });
                        });
                    }
                }
            );
        }
    }
    </script>
</head>
@section('content')
<body onload="load()" onunload="GUnload()">
    <section class="main-section">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><b>Add Bank Sampah</b></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div align="center" id="map" style="width: 1100px; height: 400px">
                </div>
            </div>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <br><br>
        <form action="{{ url('/createPostsampah') }}" method="POST">
            @csrf
          <div class="container-fluid" width="100px">
             <div class="row">

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Latitude:</strong>
                        <input id="lat" type="text" name="latitude" class="form-control">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Longtitude:</strong>
                        <input id="lng" type="text" name="longtitude" class="form-control">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Nama:</strong>
                        <input type="text" name="nama_banksampah" class="form-control">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="text" name="email_banksampah" class="form-control">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Alamat:</strong>
                        <input type="text" name="alamat_banksampah" class="form-control">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Password:</strong>
                        <input type="text" name="password_banksampah" class="form-control">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Telephone:</strong>
                        <input type="text" name="telp_banksampah" class="form-control">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Add Sticker:</strong>
                        <input type="text" name="sticker_banksampah" class="form-control">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <br>
                    <div class="form-group">
                        <select class="form-control m-bot15" name="role_id">
                            <option><b>Select User<b></option>
                            @if($roles->count() > 0)
                                @foreach($roles as $role)
                                    <option value="{{$role->role_id}}">{{$role->level}}</option>
                                @endForeach
                            @else
                                No Record Found
                            @endif   
                        </select>
                    </div>
                </div>
            </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                    <br>
                    <a class="btn btn-primary" href="{{ url('/homesampah') }}"> Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </section>
</body>
@endsection
