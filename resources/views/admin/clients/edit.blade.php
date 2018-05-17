@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-user"></i> EDIT USER
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      @include('errors')
      @include('admin.flash')

      {!! Form::model($client, ['route' => ['admin.client.save', $client->id]])!!}
        <div class="form-group">
          <label class="col-sm-3 control-label text-right  input-lg">Username</label>
          <div class="col-sm-6">
            {!! Form::text('username',null,['class' =>'form-control input-lg','disabled'=>'']) !!}
          </div>
          <div class="clearfix"></div>      


          <label class="col-sm-3 control-label text-right  input-lg">Email</label>
          <div class="col-sm-6">
            {!! Form::text('email',null,['class' =>'form-control input-lg']) !!}
          </div>
          <div class="clearfix"></div>

{{--           <label class="col-sm-3 control-label text-right  input-lg">
            Subscription End: 
          </label>
          <div class="col-sm-6">
            {!! Form::text('pkgend',null,['class' =>'form-control input-lg','id' => 'datepicker']) !!}
          </div>
          <div class="clearfix"></div>
 --}}
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
