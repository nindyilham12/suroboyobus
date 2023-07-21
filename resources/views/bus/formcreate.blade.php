@extends('/layouts/sidebar')
@section('content')
    <section class="main-section">
        <div class="content">
            <div class="row">
                 <div class="col-lg-12 margin-tb">
                     <div class="pull-left">
                        <h2><b>Add Suroboyo Bus</b></h2>
                        <hr>
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
   
        <form action="{{ url('/createPostbus') }}" method="POST">
            @csrf
          
             <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Bus:</strong>
                        <input type="text" name="nama_bus" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tipe Bus:</strong>
                        <input type="text" name="tipe_bus" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tahun Pengadaan:</strong>
                        <input type="text" name="tahun_bus" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Warna Bus:</strong>
                        <input type="text" name="warna_bus" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Plat Nomor Bus:</strong>
                        <input type="text" name="platnomor_bus" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pengguna:</strong>
                        <input type="text" name="pengguna" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-primary" href="{{ url('/homebus') }}"> Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
           
        </form>
    </section>
@endsection
