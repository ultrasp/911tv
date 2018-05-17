@extends('layouts.admin')

@section('content_title')
  <i class="fa fa-th-list"></i>ADMIN DASH BOARD
@endsection

@section('content')

    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="panel panel-info panel-stat">
          <div class="panel-heading">

            <div class="stat">
              <div class="row">
                <div class="col-xs-4">
                  <img src="images/is-user.png" alt="">
                </div>
                <div class="col-xs-8">
                  <small class="stat-label">Total Member</small>
                  <h1>{{$client_count}}</h1>
                </div>
              </div><!-- row -->
            </div><!-- stat -->

          </div><!-- panel-heading -->
        </div><!-- panel -->
      </div><!-- col-sm-6 -->


      <div class="col-sm-6 col-md-3">
        <div class="panel panel-dark panel-stat">
          <div class="panel-heading">

            <div class="stat">
              <div class="row">
                <div class="col-xs-6">
                  <small class="stat-label">TOTAL Channel</small>
                  <h1>{{$channel_count}}</h1>
                </div>
              </div>
            </div><!-- stat -->

          </div><!-- panel-heading -->
        </div><!-- panel -->
      </div><!-- col-sm-6 -->
    </div>

@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('admin/js/select2.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('admin/js/dashboard.js')}}"></script>
@endpush