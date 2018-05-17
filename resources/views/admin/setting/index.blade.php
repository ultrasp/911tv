@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-cog"></i> GENERAL SETTING
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      @include('errors')
      @include('admin.flash')
      <div class="row">
        <div class="col-md-12">
          <!-- BEGIN SAMPLE FORM PORTLET-->
          <div class="portlet light bordered">
            <div class="portlet-body form">
              {!! Form::model($setting, ['route' => ['admin.setting.save'],'files' => true,' class' => "form-horizontal"])!!}
                <div class="form-body">

                  <div class="form-group">
                    <label class="col-md-3 control-label">
                      <strong>Website Title</strong>
                    </label>
                    <div class="col-md-6">
                      {!! Form::text('sitetitle',null,['class' =>'form-control input-lg']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">
                      <strong>Email</strong>
                    </label>
                    <div class="col-md-6">
                      {!! Form::text('email',null,['class' =>'form-control input-lg']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">
                      <strong>About Text</strong>
                    </label>
                    <div class="col-md-6">
                      {!! Form::textarea('about',null,['class' =>'form-control ']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">
                      <strong>Facebook</strong>
                    </label>
                    <div class="col-md-6">
                      {!! Form::text('facebook',null,['class' =>'form-control input-lg']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">
                      <strong>Twitter</strong>
                    </label>
                    <div class="col-md-6">
                      {!! Form::text('twitter',null,['class' =>'form-control input-lg']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">
                      <strong>Google Plus</strong>
                    </label>
                    <div class="col-md-6">
                      {!! Form::text('gplus',null,['class' =>'form-control input-lg']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">
                      <strong>Instagram</strong>
                    </label>
                    <div class="col-md-6">
                      {!! Form::text('instagram',null,['class' =>'form-control input-lg']) !!}
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-3  control-label"><strong>Logo</strong></label>
                    <div class="col-sm-6">
                      {!! Form::file('logo') !!}
                      @if($setting->logo != '')
                        <img src="{{$setting->getLogoUrl()}}" class="img-responsive">
                      @endif
                    </div>
                  </div>

                  <div class="row">
                      <div class="col-md-offset-3 col-md-6">
                          <button type="submit" class="btn btn-success btn-block">UPDATE</button>
                      </div>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
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
