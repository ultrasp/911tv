@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-file-image-o"></i> Add New Member
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
              {!! Form::model($person, ['route' => ['admin.team.save'],'class' => 'form-horizontal','files' => true])!!}
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
                        Position 
                      </strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('position',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>
                        About 
                      </strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::textarea('about',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>
                        Picture 
                      </strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::file('img') !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>
                        Facebook 
                      </strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('facebook',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>
                        Twitter 
                      </strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('twitter',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>
                        Google
                      </strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('google',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>
                        Instagram
                      </strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('instagram',null,['class' =>'form-control']) !!}
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

