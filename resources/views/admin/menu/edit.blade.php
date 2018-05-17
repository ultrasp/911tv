@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-plus"></i> Edit MENU
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
              {!! Form::model($menu, ['route' => ['admin.menu.save','id' => $menu->id],'class' => 'form-horizontal'])!!}
                <div class="form-body">

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>Menu Name</strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::text('name',null,['class' =>'form-control']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <strong>Menu Bar Name</strong>
                    </label>
                    <div class="col-sm-6">
                      {!! Form::textarea('btext',null,['class' =>'form-control','id'=>"wysiwyg"]) !!}
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

@push('scripts')
  <script type="text/javascript" src="{{ asset('admin/js/wysihtml5-0.3.0.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('admin/js/bootstrap-wysihtml5.js')}}"></script>
  <script type="text/javascript" src="{{ asset('admin/js/ckeditor/ckeditor.js')}}"></script>
  <script type="text/javascript" src="{{ asset('admin/js/ckeditor/adapters/jquery.js')}}"></script>

  <script type="text/javascript">
    $('#wysiwyg').wysihtml5({color: true,html:true});
  </script>

@endpush