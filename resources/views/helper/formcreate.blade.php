@extends('/layouts/sidebar')
@section('content')
    <section class="main-section">
        <div class="content">
            <div class="row">
                 <div class="col-lg-12 margin-tb">
                     <div class="pull-left">
                        <h2><b>Add Helper</b></h2>
                        <hr>
                    </div>
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
   
        <form action="{{ url('/createPosthelper') }}" method="POST">
            @csrf
          
             <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama:</strong>
                        <input type="text" name="nama_helper" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="text" name="email_helper" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Telephone:</strong>
                        <input type="text" name="telp_helper" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Password:</strong>
                        <input type="text" name="password_helper" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
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

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-primary" href="{{ url('/homehelper') }}"> Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
           
        </form>
    </section>
@endsection
