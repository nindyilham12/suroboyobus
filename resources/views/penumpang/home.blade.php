@extends('/layouts/sidebar')
@section('content')
    <section class="main-section">
        <div class="content">
            <h2><b>List Penumpang</b></h2>
            <hr>       
        </div>

        <div style="float: right;" >
            <input style="height: 30px; width: 200px" id="myInput" type="text" placeholder="Search">
            <button style="height: 30px;" type="submit"><i class="fa fa-search"></i></button>
        </div>
        <br><br>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
   
        <table  class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telephone</th>
                    <th>Sticker</th>
                </tr>
            </thead>
            
            <tbody id="myTable">
                @foreach ($penumpang as $num => $data)
                <tr>
                    <td>{{ $num+1 }}</td>
                    <td>{{ $data->nama_penumpang }}</td>
                    <td>{{ $data->telp_penumpang }}</td>
                    <td>{{ $data->sticker_penumpang }}</td>
                </tr>
                @endforeach 
            </tbody>
        </table>

         {!! $penumpang->links() !!}

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
