@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	@if($post)
    			<div class="col-md-12">
                    <h3>
                        <a href="{{route('viewPost', $post->id)}}">{{$post->title}}</a>
                        <small>({{$post->author_id}})</small>
                    </h3>
                    <p>{{$post->content}}</p>
                </div>
        	@endif
        </div>

        
        <div class="col-md-12">
          <div class="col-md-12" id="post-comments">
            <h4>Comments:</h4>
            <div class="col-md-12" v-if="user">
              <textarea name="comment" class="form-control" v-model="commentBox"></textarea>
              <input type="submit" value="Save" class="btn btn-primaray" />
            </div>
            <div v-else>
              <div class="col-md-12">

              </div>
            </div>
          </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
  const app = new Vue({
    el: '#app',
    data: {
      comments: {},
      post: {},
      user: {},
      commentBox: 'hi'
    }
  });
</script>
@endsection
