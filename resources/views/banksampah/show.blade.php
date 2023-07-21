@extends('/layouts/sidebar')
@section('content')
    <section class="main-section">
        <div class="content">
            <h2><b>History Transaksi Sampah</b></h2>
            <hr>      
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
                    <th>Nama Penumpang</th>
                    <th>Send Sticker</th>
                    <th>Botol Besar</th>
                    <th>Botol Medium</th>
                    <th>Gelas Plastik</th>
                    <th>Tanggal/Waktu</th>
                    <th width="170px">Action</th>
                </tr>
            </thead>

            <tbody id="myTable">
                @foreach ($data as $num => $data)
                <tr>
                    <td>{{ $num+1 }}</td>
                    <td>{{ $data->get_penumpang->nama_penumpang}}</td>
                    <td>{{ $data->sticker_tukarsampah }}</td>
                    <td>{{ $data->botolbesar_tukarsampah }}</td>
                    <td>{{ $data->botolmedium_tukarsampah }}</td>
                    <td>{{ $data->gelasplastik_tukarsampah }}</td>
                    <td>{{ $data->datetime }}</td>
                    <td>
                        <form action="{{url('/deletesampah',$data->id_banksampah)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-danger" href="{{ url('/deletesampah',$data->id_banksampah) }}">Delete</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

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
