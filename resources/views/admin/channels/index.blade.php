@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-th-list"></i> CHANNEL LIST
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      @include('admin.flash')
     <div class="clearfix mb30"></div>
      <div class="table-responsive">
        <table class="table table-striped" id="table2">
          <thead>
            <tr>
              <th>#</th>
              <th>Channel title</th>
              <th>Image</th>
              <th>EDIT</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach($channels as $key => $item)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$item->title}}</td>
              <td>
                <img src="{{$item->getImageUrl()}}" width="100">
              </td>
              <td><a href="{{route('admin.channel.edit',['id' => $item->id])}}"><button class="btn btn-info btn-xs">EDIT</button></a></td>
              <td><a href="{{route('admin.channel.delete',['id' => $item->id])}}"><button class="btn btn-danger btn-xs">DELETE</button></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div><!-- table-responsive -->
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('admin/js/select2.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('admin/js/dashboard.js')}}"></script>
@endpush