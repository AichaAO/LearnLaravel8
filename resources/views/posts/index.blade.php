@extends('layout')
{{-- //everything that starts with @ is called a directive --}}


@section('content')

    <h1> Lists  of posts</h1>
    <ul class="list-group">
        @forelse ($posts as $post)
        <li  clas="list-group-item">  
                <h2> <a href="{{route('posts.show', ['post'=> $post->id])}}">{{$post->title}} </a> </h2>
                {{-- <h2> <a href="/posts/{{$post->id}}">  {{$post->title}}   </a>    </h2> --}}
                <p>{{$post->content}}</p>
                <em> {{$post->created_at}}</em>
               
                @if($post->comments_count)
                    <div>
                    <span >  {{ $post->comments_count }} comment </span>
                    </div>
                    
                @else
                    <div>
                        <span >   no comments yet!  </span>
                    </div>
                    
                @endif



                <a  class="btn btn-warning" href="{{ route('posts.edit', ['post'=> $post->id])}}">  Edit    </a>


                <form class="form-inline" method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                    @csrf        {{--   To generate a token in order to secure the form transmission --}}
                    
                    @method('DELETE')  {{-- the html5 doesn't support the put method, so we use this method to overwrite the post methode --}}
                
                
                    <button  class="btn btn-danger" type="submit"> Delete post</button>
                </form>
        </li>    

        @empty
            <span  class="badge badge-danger"> NO POSTS </span>
            
        @endforelse
        
    </ul>
@endsection 