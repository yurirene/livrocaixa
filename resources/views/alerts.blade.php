@if ($message = Session::get('message'))
<div class="alert alert-{{$message['type']}} alert-dismissible fade show" role="alert">
        <strong>{{ $message['text'] }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif