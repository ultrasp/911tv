@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-cog"></i> SET HOME TEXT
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
              {!! Form::model($setting, ['route' => ['admin.setting.text.save'],'class' => "form-horizontal"])!!}
                <div class="form-body">

                  <div class="form-group">
                    <label class="col-md-3 control-label">
                      <strong>Menu Name</strong>
                    </label>
                    <div class="col-md-6">
                      {!! Form::text('head',null,['class' =>'form-control input-lg']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">
                      <strong>Menu Bar Name</strong>
                    </label>
                    <div class="col-md-6">
                      {!! Form::textarea('htext',null,['class' =>'form-control input-lg']) !!}
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
