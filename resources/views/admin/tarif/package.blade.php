@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-dollar"></i> PACKAGE SETTING
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
              {!! Form::open(['route' => 'admin.package.save','class' => 'form-horizontal']) !!}

                <div class="form-body">
                  @foreach($plans as $plan)
                    <div class="form-group">
                      <label class="col-sm-3 control-label">
                        <strong>{{$plan->info}}</strong>
                      </label>
                      <div class="col-sm-6">
                        {!! Form::text('price['.$plan->id.']',$plan->price,['class' =>'form-control']) !!}
                      </div>
                    </div>
                  @endforeach

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

