@extends('/layouts/sidebar')
@section('content')
    <section class="main-section">
        <div class="content">
            <h2><b>History Get Sticker</b></h2>
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
                    <th>Tanggal/Waktu</th>
                    <th width="170px">Action</th>
                </tr>
            </thead>

            <tbody id="myTable">
                @foreach ($data as $num => $data)
                <tr>
                    <td>{{ $num+1 }}</td>
                    <td>{{ $data->get_penumpang->nama_penumpang}}</td>
                    <td>{{ $data->sticker_naikbus }}</td>
                    <td>{{ $data->datetime }}</td>
                    <td>
                        <form action="{{url('/deletehelper',$data->id_helper)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-danger" href="{{ url('/deletehelper',$data->id_helper) }}">Delete</a>
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
