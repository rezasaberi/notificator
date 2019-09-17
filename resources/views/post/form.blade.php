@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<form action="{{route('savePost')}}" method="post">
                @csrf

                <label>Title</label>
                <input type="text" name="title" class="form-control" />

                <label>Content</label>
                <textarea name="content" class="form-control" rows="4"></textarea>

                <br />
                <input type="submit" value="Save" class="btn btn-primary" />
            </form>
        </div>
    </div>
</div>
@endsection