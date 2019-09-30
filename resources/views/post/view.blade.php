@extends('layouts.app')



@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
    	@if($post)
			<div class="col-md-12">
        <h3>
          <a href="{{route('viewPost', $post->id)}}">{{$post->title}}</a>
          <small>({{$post->user->name}})</small>
        </h3>
        <p>{{$post->content}}</p>
      </div>
    	@endif
    </div>

    
    <div class="col-md-12">
      <div class="col-md-12" id="post-comments">
        <h4>Your Comment:</h4>
        <div v-if="user">
          <textarea name="comment" class="form-control" v-model="commentBox"></textarea>
          <button class="btn btn-primaray" @click.prevent="postComment">Save</button>
        </div>
        <div v-else style="border: 1px solid #ccc; padding: 5px; border-radius: 5px;">
          <p><i class="fa fa-infi-circle"></i> You must be logged in to write your comment!</p>
          <a href="{{route('login')}}">Login</a>
        </div>
        <div v-if="comments.length > 0">
          <hr />
          <h4>Comments:</h4>
          <div v-for="comment in comments">
            <p><strong>@{{comment.user.name}}</strong>: @{{comment.body}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>

  const app = new Vue({
    el: '#app',
    data: {
      comments: {},
      post: {!! $post->toJson() !!},
      user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!},
      commentBox: ''
    },
    mounted(){
      this.getComments();
      this.listen();
    },
    methods:{
      getComments(){
        //axios.get('/api/posts/'+this.post.id+'/comments')
        axios.get(`/api/posts/${this.post.id}/comments`)
          .then((response) => {
            this.comments = response.data
          })
          .catch(function(error){
            console.log(error);
          });
      }, 
      postComment(){
        axios.post(`/api/posts/${this.post.id}/comment`, {
          api_token: this.user.api_token,
          body: this.commentBox
        })
        .then((response) => {
          this.comments.unshift(response.data);
          this.commentBox = '';
        })
        .catch(function(error){
          console.log(error);
        });
      },
      listen(){
        Echo.private('post-'+this.post.id).listen('NewComment', (comment) => {
          console.log(comment);
          this.comments.unshift(comment);
        });
      }
    }
  });
</script>
@endpush
