@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-user"></i> EDIT Admin password
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      @include('errors')
      @include('admin.flash')

      {!! Form::model($user, ['route' => ['admin.change_pass']])!!}
        <div class="form-group">
          <label class="col-sm-3 control-label text-right  input-lg">Username</label>
          <div class="col-sm-6">
            {!! Form::text('username',null,['class' =>'form-control input-lg']) !!}
          </div>
          <div class="clearfix"></div>      


          <label class="col-sm-3 control-label text-right  input-lg">Password</label>
          <div class="col-sm-6">
            <input class="form-control input-lg" name="password" type="text">
          </div>
          <div class="clearfix"></div>

          <div class="col-sm-3"></div>
          <div class="col-sm-6">
            <input type="submit" class="btn btn-success btn-block" value="Update">  
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{asset('admin/css/bootstrap-timepicker.min.css')}}" />
  <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-wysihtml5.css')}}" />
@endpush
@push('scripts')
  <script type="text/javascript" src="{{ asset('admin/js/bootstrap-datetimepicker.min.js') }}"></script>
  <script type="text/javascript">
    //$('#datepicker').datetimepicker({format: 'DD/MM/YYYY'});
  </script>
@endpush
