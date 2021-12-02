@extends('layout')

@section('content')

<form action=""></form>

{{-- form>(div>label+input)*2 --}}

{{-- to generate a text with a certain length, we use lorem20, 20 is the length --}}
<h1> Edit Post</h1>
<form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}">
    @csrf        {{--   To generate a token in order to secure the form transmission --}}
    
    @method('PUT')  {{-- the html5 doesn't support the put method, so we use this method to overwrite the post methode --}}


    @include('posts.form')

    <button class="btn btn-block btn-warning form-control" type="submit"> update post</button>
</form>
    
@endsection