@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-file-image-o"></i> Add New Testimonial
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
              {!! Form::model($testimonial, ['route' => ['admin.testimonial.save'],'cl