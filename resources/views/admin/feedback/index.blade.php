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
              <th>User</th>
              <th>EDIT</th>
            </tr>
          </thead>
          <tbody>
            @foreach($chatters as $key => $item)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$item->sender->username}}</td>
              <td>
                <a href="{{route('admin.chat',['id' => $item->user_id])}}"><button class="btn btn-info btn-xs"><i class="fa fa-envelope"></i></button></a>
                <a href="{{route('admin.feedback.delete',['id' => $item->user_id])}}"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></a>
              </td>
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