@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-file-image-o"></i> All Pricing Plan
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      @include('admin.flash')
      <a class="btn btn-primary" href="{{route('admin.tarif.add')}}">
        <i class="fa fa-plus"></i>
      </a>
      <div class="table-responsive">
        <table class="table table-striped" id="table2">
          <thead>
            <tr>
              <th>#</th>
              <th>Channel</th>
              <th>Price</th>
              <th>Period</th>
              <th>EDIT</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tarifs as $key => $item)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$item->channel->title}}</td>
              <td>{{$item->price}}$</td>
              <td>{{$item->period}} month</td>
              <td><a href="{{route('admin.tarif.edit',['id' => $item->id])}}"><button class="btn btn-info btn-xs">EDIT</button></a></td>
              <td><a href="{{route('admin.tarif.delete',['id' => $item->id])}}"><button class="btn btn-danger btn-xs">DELETE</button></a></td>
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