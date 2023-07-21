@extends('/layouts/sidebar')
@section('content')
    <section class="main-section">
        <div class="content">
            <div class="row">
                 <div class="col-lg-12 margin-tb">
                     <div class="pull-left">
                        <h2><b>Edit Bus</b></h2>
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
  
        <form action="{{url('/updatebus',$data->id_bus)}}" method="POST">
            @csrf
            @method('PUT')
       
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Bus:</strong>
                        <input type="text" name="nama_bus" value="{{$data->nama_bus}}" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tipe Bus:</strong>
                        <input type="text" name="tipe_bus" value="{{$data->tipe_bus}}" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tahun Pengadaan:</strong>
                        <input type="text" name="tahun_bus" value="{{$data->tahun_bus}}" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Warna Bus:</strong>
                        <input type="text" name="warna_bus" value="{{$data->warna_bus}}" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Plat Nomor Bus:</strong>
                        <input type="text" name="platnomor_bus" value="{{$data->platnomor_bus}}" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pengguna:</strong>
                        <input type="text" name="pengguna" value="{{$data->pengguna}}" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-primary" href="{{url('/homebus')}}"> Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>       

    </section>
@endsection
