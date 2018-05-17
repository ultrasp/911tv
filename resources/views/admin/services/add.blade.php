@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-file-image-o"></i> Add New Service
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <div class="portlet light bordered">
            <div class="portlet-body form">
              @include('errors')
              @include('admin.flash')
              {!! Form::model($service, ['route' => ['admin.service.save'],'class' => 'form-horizontal'])!!}
                <div class="form-body">
                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>NAME</strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('name',null,['class' =>'form-control']) !!}
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>
                        Icon Class (like fa-search) 
                        <i class="fa fa-search"></i>
                      </strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('icon',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>
                        Description 
                      </strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::textarea('stext',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                      <button type="submit" class="btn btn-success btn-block">ADD NEW</button>
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

