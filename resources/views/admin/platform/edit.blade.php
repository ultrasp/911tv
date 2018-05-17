@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-file-image-o"></i> Edit Platform
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
              {!! Form::model($platform, ['route' => ['admin.platform.save','id' => $platform->id],'class' => 'form-horizontal'])!!}
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
                      <strong>Platform used operation system</strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('os',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>Addition information</strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('dop_info',null,['class' =>'form-control summernote']) !!}
                    </div>
                  </div>

                  <button class="add_input btn btn-primary" type="button">ADD step to instruction</button>
                  <div class="steps">
                    @if($platform->steps->count() == 0)
                      <div class="form-group first">
                        <label class="col-sm-3 control-label">
                          <strong>
                            Instuction 1 
                          </strong>
                        </label>
                        <div class="col-sm-9 content_wrapper">
                          {!! Form::textarea('content[]',null,['class' =>'form-control summernote']) !!}
                        </div>
                      </div>
                    @endif
                    @foreach($platform->steps as $key => $step)
                    <div class="form-group posts {{($key == 0 ) ? 'first' : ''}}">
                      <label class="col-sm-3 control-label">
                        <strong>
                          Instuction <span class="step_number">{{$step->number}}</span> 
                        </strong>
                          <button class="remove_input btn btn-danger" type="button">  <i class="fa fa-minus"></i>
                          </button>
                          <button class="totop btn btn-primary" type="button">
                            <i class="fa fa-arrow-up"></i>
                          </button>
                          <button class="tobottom btn btn-primary" type="button">
                            <i class="fa fa-arrow-down"></i>
                          </button>
                      </label>
                      <div class="col-sm-9 content_wrapper">
                        {!! Form::textarea('content[]',$step->content,['class' =>'form-control summernote']) !!}
                      </div>
                    </div>
                    @endforeach
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label text-right  input-lg">
                      Device type
                    </label>
                    <div class="col-md-9">
                      <select name="type[]" class="form-control input-lg" multiple>
                        @foreach(\App\Models\Platform::getLabels() as $key=> $item)
                          <option value="{{$key}}" {{in_array($key, $platform->getTypes()) ? 'selected' :  '' }}>{{$item}}</option>
                        @endforeach
                      </select>
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

