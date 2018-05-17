@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-th-list"></i> CHANNEL LIST
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <div class="portlet light bordered">
            <div class="portlet-title">
              <div class="caption font-dark"></div>
              <div class="tools"> </div>
            </div>
            <div class="portlet-body">
            @include('admin.flash')
            <a href="{{route('admin.menu.add')}}" class='btn btn-success btn-block'>ADD MENU</a>
              <table class="table table-striped table-bordered table-hover" id="table2">
                <thead>
                  <tr>
                    <th> ID# </th>
                    <th> Name </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($menus as $key => $menu)
                  <tr>
                    <td>{{$menu->id}}</td>
                    <td>{{$menu->name}}</td>
                    <td>
                      <a href="{{route('admin.menu.edit',['id'=>$menu->id])}}">
                        <button class="btn btn-info btn-xs"> 
                          <i class="fa fa-edit"></i>
                          EDIT
                        </button>
                      </a>
                      <a href="{{route('admin.menu.delete',['id' => $menu->id])}}">
                        <button class="btn btn-danger btn-xs"> 
                          <i class="fa fa-times"></i> 
                          DELETE
                        </button>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('admin/js/select2.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('admin/js/dashboard.js')}}"></script>
@endpush