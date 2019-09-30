@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h4>Available Posts: <span></span>
    	@if($posts)
    		@foreach($posts As $post)
    			<div class="col-md-12">
            <h3><a href="{{route('viewPost', $post->id)}}">{{$post->title}}</a></h3>
            <p>{{$post->content}}</p>
          </div>
    		@endforeach
    	@endif
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  Pusher.logToConsole = true;

  var public_pusher = new Pusher('904d58aa759c8397d000', {
    cluster: 'ap2',
    forceTLS: true
  });

  var main_channel = public_pusher.subscribe('posts');
  main_channel.bind('NewPostEvent', function(data) {
    console.log(JSON.stringify(data));
  });
</script>
@endsection