@if ($message = Session::get('message'))
<div class="alert alert-{{$message['type']}} =">	
        <strong>{{ $message['text'] }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
</div>
@endif