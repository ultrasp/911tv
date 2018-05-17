@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-file-image-o"></i> List Platforms
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      @include('admin.flash')
      <a href="{{route('admin.platform.add')}}" class='btn btn-success btn-block'>ADD Platform</a>
      <div class="clearfix mb30"></div>
      <div class="table-responsive">
        <table class="table table-striped" id="table2">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>type</th>
              <th>EDIT</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach($platforms as $key => $item)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$item->name}}</td>
              <td>
                @foreach($item->getTypes() as $type)
                {{$item->getLabel($type)}}, 
                @endforeach
              </td>
              <td><a href="{{route('admin.platform.edit',['id' => $item->id])}}"><button class="btn btn-info btn-xs">EDIT</button></a></td>
              <td><a href="{{route('admin.platform.delete',['id' => $item->id])}}"><button class="btn btn-danger btn-xs">DELETE</button></a></td>
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