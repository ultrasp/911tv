@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-file-image-o"></i> Add Platform
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
              {!! Form::model($platform, ['route' => ['admin.platform.save'],'class' => 'form-horizontal'])!!}
                <div class="form-body">
                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>Platform name</strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('name',null,['class' =>'form-control']) !!}
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>
                        Instuction 
                      </strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::textarea('content',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label text-right  input-lg">
                      Device type
                    </label>
                    <div class="col-md-6">
                      {!! Form::select('type', \App\Models\Platform::getLabels(),null,['class'=>'form-control input-lg']) !!}
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

