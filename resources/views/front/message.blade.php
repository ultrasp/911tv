<div class="chat-message-{{ (Auth::id() == $message->user_id ) ? 'fromuser' : 'touser'}} msg-read">
    <ul class="ulclass">
        <li class="liclass">{{$message->created_at->format('d.m.Y H:i')}}</li>
        <li class="liclass"> 
        	<span class="chat_username">
        		{{$message->sendername()}}
        	</span>
        </li>
        
    </ul>
    <span>{{$message->message}}</span>
</div>