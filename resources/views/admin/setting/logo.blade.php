@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-cog"></i> SET LOGO
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      @include('errors')
      @include('admin.flash')
      <div class="row">
        {!! Form::model($setting, ['route' => ['admin.logo.save'],'files' => true,' class' => "form-horizontal"])!!}

            <div class="form-group">
              <div class="col-sm-6"><label for="bgimg" class="control-label">Logo</label></div>
              <div class="col-sm-6">
                {!! Form::file('logo') !!}
                @if($setting->logo != '')
                  <img src="{{$setting->getLogoUrl()}}" class="img-responsive">
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-6">
                <label for="icon" class="control-label">Logo icon</label>
              </div>
              <div class="col-sm-6">
                {!! Form::file('icon') !!}
                @if($setting->icon != '')
                  <img src="{{$setting->getIconUrl()}}" class="img-responsive">
                @endif
              </div>
              <br>
              <br>
              <div class="col-sm-6"> 
                <button type="submit" class="btn btn-primary btn-block">
                  UPLOAD
                </button>
              </div>
            </div>

          {!! Form::close() !!}
        </div>
      </div>
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
