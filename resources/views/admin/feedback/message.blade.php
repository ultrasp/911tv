<div class="row">
  <div class="col-md-6 {{ ($message->user_id == \App\Models\Feedback::USER_ADMIN) ? 'col-md-offset-6' : '' }}">
    <div class="panel panel-default">
          <div class="panel-body">
            <h4 class="title">{{$message->sendername()}}</h4>
            {{$message->message}}
          </div>
    </div>
  </div>
</div>
