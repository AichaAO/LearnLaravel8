@extends('layout')

@section('content')

<form action=""></form>

{{-- form>(div>label+input)*2 --}}

{{-- to generate a text with a certain length, we use lorem20, 20 is the length --}}
<h1> New Post</h1>
<form method="POST" action="{{ route('posts.store') }}">
    @csrf        {{--   To generate a token in order to secure the form transmission --}}


    @include('posts.form')

    <button class="btn btn-block btn-primary form-control"  type="submit"> Add post</button>
</form>
    
@endsection