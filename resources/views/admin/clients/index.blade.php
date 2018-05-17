@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-users"></i>VIEW ALL USERS
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
              <th>Username</th>
              <th>Email</th>
              <th>Email activated</th>
              <th>EDIT</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach($clients as $key => $item)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$item->username}}</td>
              <td>{{$item->email}}</td>
              <td>
                <p class="btn btn-{{is_null($item->email_activate_token) ? 'success' : 'danger' }}-alt btn-xs">
                  {{is_null($item->email_activate_token) ? 'Approved' : 'Not approved' }}
                </p>
              </td>
              <td><a href="{{route('admin.client.edit',['id' => $item->id])}}"><button class="btn btn-info btn-xs">EDIT</button></a></td>
              <td><a href="{{route('admin.client.delete',['id' => $item->id])}}"><button class="btn btn-danger btn-xs">DELETE</button></a></td>
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