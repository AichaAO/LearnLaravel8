@extends('layout')

@section('content')


 {{-- instead of writing "echo" we use double beackets {{}},
 we call them "interpolation" in french   
 
 we add !! instead of {{}} in order to interpret the html or javascript 
 tags like the one I used (<a>) in the line 44 of web.php file

     {!! $data['title'] !!}
 
 --}} 
    
    <h1> {{$post->title}}</h1>
    <p>{{$post->content}}</p>
    <em> {{$post->created_at->diffForHumans()}}</em>

    <p> Status: 
        
        @if ($post->active)
            Enabled
        @else
            Disabled
        @endif
        
    
    </p>


@endsection 