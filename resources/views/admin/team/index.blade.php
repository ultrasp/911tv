@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-file-image-o"></i> List Features
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      @include('admin.flash')
      <a href="{{route('admin.team.add')}}" class='btn btn-success btn-block'>ADD New Member</a>
      @foreach($members as $key => $item)
        <div class="col-md-6 col-sm-12">
          <h3 style="font-weight:bold; min-height:40px;">{{$item->name}} </h3> <br><br>
          <img src="{{$item->getImgUrl()}}" 
            style="height: 250px;margin: 0 auto;" 
            alt="{{$item->name}}" class="img-responsive">
          <div class="col-md-6">
            <a href="{{route('admin.team.delete',['id' => $item->id])}}" class='btn btn-danger btn-block'>DELETE</a>
            
          </div>
          <div class="col-md-6">
            <a href="{{route('admin.team.edit',['id' => $item->id])}}" class='btn btn-primary btn-block'>EDIT</a>
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