@extends('/layouts/sidebar')
@section('content')
    <section class="main-section">
        <div class="content">
            <h2><b>List Suroboyo Bus</b></h2>
            <hr>
             <div class="pull-left">
                <a class="btn btn-success" href="{{ url('/createbus') }}"> Create Bus</a>
            </div>       
        </div>

        <div style="float: right;">
            <input style="height: 30px; width: 200px" id="myInput" type="text" placeholder="Search">
            <button style="height: 30px;" type="submit"><i class="fa fa-search"></i></button>
        </div>
        <br><br>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
   
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Tahun Pengadaan</th>
                    <th>Warna</th>
                    <th>Plat Nomor</th>
                    <th>Pengguna</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            
            <tbody id="myTable">
                @foreach ($bus as $num => $data)
                <tr>
                    <td>{{ $num+1 }}</td>
                    <td>{{ $data->nama_bus }}</td>
                    <td>{{ $data->tipe_bus }}</td>
                    <td>{{ $data->tahun_bus }}</td>
                    <td>{{ $data->warna_bus }}</td>
                    <td>{{ $data->platnomor_bus }}</td>
                    <td>{{ $data->pengguna }}</td>
                    <td>
                        <form action="{{url('/deletebus',$data->id_bus)}}" method="POST">
                            <a class="btn btn-info" href="{{ url('/showbus',$data->id_bus) }}">Show</a>
                            <a class="btn btn-primary" href="{{ url('/editbus',$data->id_bus) }}">Edit</a>
                            @csrf
                            <a class="btn btn-danger" href="{{ url('/deletebus',$data->id_bus) }}">Delete</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

         {!! $bus->links() !!}

    </section>
    <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    </script>
@endsection
