@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-file-image-o"></i> Edit Pricing Plan
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
              {!! Form::model($tarif, ['route' => ['admin.tarif.save','id' => $tarif->id],'class' => 'form-horizontal'])!!}
                <div class="form-body">

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>Channel</strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::select('channel_id',\App\Models\Channel::getList(),null,['class' =>'form-control']) !!}
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>Price</strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('price',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>Period (month)</strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('period',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>Api id</strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('api_id',null,['class' =>'form-control']) !!}
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

