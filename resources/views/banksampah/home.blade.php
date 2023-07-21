@extends('/layouts/sidebar')
@section('content')
    <section class="main-section">
        <div class="content">
            <h2><b>List Bank Sampah</b></h2>
            <hr>
             <div class="pull-left">
                <a class="btn btn-success" href="{{ url('/createsampah') }}"> Create Bank Sampah</a>
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
                    <th>Telephone</th>
                    <th>Sticker</th>
                    <th>Botol Besar</th>
                    <th>Botol Medium</th>
                    <th>Gelas Plastik</th>
                    <th>Jumlah Botol</th>
                    <th>Latitude</th>
                    <th>Longtitude</th>
                    <th width="220px">Action</th>
                </tr>
            </thead>

            <tbody id="myTable">
                @foreach ($banksampah as $num => $data)
                <tr>
                    <td>{{ $num+1 }}</td>
                    <td>{{ $data->nama_banksampah }}</td>
                    <td>{{ $data->telp_banksampah }}</td>
                    <td>{{ $data->sticker_banksampah }}</td>
                    <td>{{ $data->botolbesar_banksampah }}</td>
                    <td>{{ $data->botolmedium_banksampah }}</td>
                    <td>{{ $data->gelasplastik_banksampah }}</td>
                    <td>{{ $data->sampah_banksampah }}</td>
                    <td>{{ $data->latitude }}</td>
                    <td>{{ $data->longtitude }}</td>
                    <td>
                        <form action="{{url('/deletesampah',$data->id_banksampah)}}" method="POST">
                            <a class="btn btn-info" href="{{ url('/showsampah?user_id_banksampah=')}}{{$data->user_id_banksampah}}">History</a>
                            <a class="btn btn-primary" href="{{ url('/editsampah',$data->id_banksampah) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-danger" href="{{ url('/deletesampah',$data->id_banksampah) }}">Delete</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

         {!! $banksampah->links() !!}

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
