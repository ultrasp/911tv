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
        <div class="chat_list">
        @foreach($chat as $key => $message)
        <div class="row">
          <div class="col-md-6 {{ ($message->user_id == \App\Models\Feedback::USER_ADMIN) ? 'col-md-offset-6' : '' }}">
            <div class="panel panel-default">
                  <div class="panel-body">
                    <h4 class="title">{{$message->sendername()}}</h4>
                    {{$message->message}}
                  </div>
                  <div>
                    <a href="{{route('admin.message.delete',['id' => $message->id])}}">
                      <button class="btn btn-danger btn-xs">
                        <i class="fa fa-trash-o"></i>
                      </button>
                    </a>  
                  </div>
            </div>
          </div>
          </div>
        @endforeach
        </div>
          <form class="form transparent border-white" id="form-ask-question" action="{{route('admin.message.save',['user_id' => $user_id])}}">
            <div class="form-group">
              <textarea name="text-msg" id="text-msg" placeholder="Напишите вопрос" required="" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" value="" class="btn btn-primary">
                Ответить
              </button>
            </div>
        </form>

      </div><!-- table-responsive -->
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('admin/js/select2.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('admin/js/dashboard.js')}}"></script>
@endpush