@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-file-image-o"></i> Edit Slide
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
              {!! Form::model($slide, ['route' => ['admin.slide.save','id'=>$slide->id],'class' => 'form-horizontal','files' => true])!!}
                <div class="form-body">
                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>SLIDER IMAGE</strong>
                    </label>
                    <div class="col-sm-3">
                      {!! Form::file('img') !!}
                    </div>
                    <div class="col-sm-3">
                      <b style="color:red; font-weight: bold;"> 
                        Size Must Be 1920 X 650
                      </b>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>
                        Caption Markup 
                      </strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::textarea('stext',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                      <button type="submit" class="btn btn-success btn-block">Update</button>
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

