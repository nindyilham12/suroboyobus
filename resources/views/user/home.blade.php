@extends('/layouts/sidebar')
@section('content')
    <section class="main-section">
        <div class="content">
            <h2><b>List User</b></h2>
            <hr>
             <div class="pull-left">
                <a class="btn btn-success" href="{{ url('/create') }}"> Create Admin</a>
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
                    <th>Email</th>
                    <th>Level User</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($users as $num => $user)
                <tr>
                    <td>{{ $num+1 }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->get_role->level}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

         {!! $users->links() !!}

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
