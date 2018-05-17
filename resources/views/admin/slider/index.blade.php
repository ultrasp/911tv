@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-file-image-o"></i> List Slides
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      @include('admin.flash')
      <a href="{{route('admin.slide.add')}}" class='btn btn-success btn-block'>ADD Slide</a>
      @foreach($slides as $key => $item)
        <div class="col-md-6 col-sm-12">
          <img src="{{$item->getImgUrl()}}" 
            style="height: 250px;margin: 0 auto;" 
            class="img-responsive">
          <div>
            {!! $item->stext !!}
          </div>
          <div class="col-md-6">
            <a href="{{route('admin.slide.delete',['id' => $item->id])}}" class='btn btn-danger btn-block'>DELETE</a>
            
          </div>
          <div class="col-md-6">
            <a href="{{route('admin.slide.edit',['id' => $item->id])}}" class='btn btn-primary btn-block'>EDIT</a>
          </div>
          <br><br><br><br>
        </div>
      @endforeach
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('admin/js/select2.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('admin/js/dashboard.js')}}"></script>
@endpush