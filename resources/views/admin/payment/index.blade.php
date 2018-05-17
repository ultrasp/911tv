@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-dollar"></i> PAYMENT LOG
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      @include('admin.flash')
      <div class="row">
        <div class="col-md-12">
          <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
              <table class="table table-striped table-bordered table-hover" id="table2">
                <thead>
                  <tr>
                    <th> ORDER NUMBER </th>
                    <th> AMOUNT </th>
                    <th> SERVICE </th>
                    <th> SERVICE TRANSACTION </th>
                    <th> TIME </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($transactions as $key => $transaction)
                  <tr>
                    <td>
                      @if($transaction->order)
                      {{$transaction->order->id}}
                      @else
                      {{$transaction->id." has not order"}}
                      @endif
                    </td>
                    <td>{{$transaction->amount}} {{$transaction->currency}}</td>
                    <td> {{$transaction->service}} </td>
                    <td>{{$transaction->transaction_id}}</td>
                    <td>{{$transaction->created_at->format('d.m.Y H:i')}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div><!-- table-responsive -->
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