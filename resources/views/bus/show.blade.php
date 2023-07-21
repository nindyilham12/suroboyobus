@extends('/layouts/sidebar')
@section('content')
    <section class="main-section">
        <div class="content">
            <div class="row">
                 <div class="col-lg-12 margin-tb">
                     <div class="pull-left">
                        <h2><b>Detail Bus</b></h2>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Nama Bus </strong></td>
                        <td>{{ $data->nama_bus }}</td>
                    </tr>

                    <tr>
                        <td><strong>Tipe Bus </strong></td>
                        <td>{{ $data->tipe_bus }}</td>
                    </tr>

                    <tr>
                        <td><strong>Tahun Pengadaan </strong></td>
                        <td>{{ $data->tahun_bus }}</td>
                    </tr>

                    <tr>
                        <td><strong>Warna Bus </strong></td>
                        <td>{{ $data->warna_bus }}</td>
                    </tr>

                    <tr>
                        <td><strong>Plat Nomor Bus </strong></td>
                        <td>{{ $data->platnomor_bus }}</td>
                    </tr>

                    <tr>
                        <td><strong>Pengguna </strong></td>
                        <td>{{ $data->pengguna }}</td>
                    </tr>
                </table>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-primary" href="{{url('/homebus')}}"> Back</a>
                </div>

            </div>
    </div>

    </section>
@endsection
