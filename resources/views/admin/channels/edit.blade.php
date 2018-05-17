@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-desktop"></i> Edit CHANNEL
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      @include('errors')
      @include('admin.flash')

      {!! Form::model($channel, ['route' => ['admin.channel.save','id' => $channel->id], 'files' => true])!!}
        <div class="form-group">

          <label class="col-sm-3 control-label text-right  input-lg">
            Channel Name
          </label>
          <div class="col-sm-6">
            {!! Form::text('title',null,['class' =>'form-control input-lg']) !!}
          </div>
          <div class="clearfix"></div>

          <label class="col-sm-3 control-label text-right  input-lg">Channel Image</label>
          <div class="col-sm-6">
            {!! Form::file('img',['class'=>'form-control']) !!}
          </div>
          <div class="clearfix"></div>

          <label class="col-sm-3 control-label text-right  input-lg">List channels</label>
          <div class="col-sm-6">
            {!! Form::textarea('content',null,['class' =>'form-control']) !!}
          </div>
          <div class="clearfix"></div>

          <div class="col-sm-3"></div>
          <div class="col-sm-6">
            <input type="submit" class="btn btn-success btn-block" value="Update">
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection

