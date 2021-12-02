<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd(Post::all());   this is used for debugging

      /* to see and log the executed sql request
      * but this part doesn't work
        DB::enableQueryLog();
        $posts= Post::with('comment')->get();
        foreach($posts as $post) {

            foreach( $post -> comment as $comment) {
                dump(($comment));
            }
        }
        dd(DB::getQueryLog()); */





        $posts= Post::withCount('comments')->get();


        return view('posts.index',[
            'posts' => $posts
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost  $request)
    {
       /* dd($request->all());
         $title=$request->input('title');
         $content=$request->input('content');
         dd($title, 'content: ', $content);

        --in order to validate the data before sending it to the db
        we shoud use this validation system 
        --bail is used to tell laravel not to verify the next condition if 
        the one before is not valid*/
        
        /*$validatedData = $request->validate([
            'title' => 'bail|required|min:4|max:100',
            'content' => 'required'
        ]);*/

        /*   I  made the section above a comment because
        I want to replace it to the Request file called
        StorePost, created inside the Http folder. And the way 
        I use the Request file is by creating the $request object
        using the StorePost constuctor instead of the Request  constructor
        */ 


        /*
        $post= new Post();
        $post->title=$request->input('title');
        $post->content=$request->input('content');
        $post->slug= Str::slug($post->title,'-'); //slug helps us to change the space with the dash -
        $post->active = false;
        $post->save();

        */

        $data = $request->only(['title','content']);
        $data['slug']=Str::slug($data['title'],'-');
        $data['active']=false;
        $post= Post::create($data);




       
        //flash message est une variable de session, sa durée de vie est une requête http
        //after refreshing the page, the flash message disapears, is distroyed
        //we shoud declare it before redirection

        $request->session()->flash('status', 'post was created!!');

        //return redirect('/posts');  <=>  return redirect()->route('posts.index');
        return redirect()->route('posts.show', ['post' => $post->id] );




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show',[
            'post' => Post::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$post = Post::find($id); we use the method below instead of this one, 
        in order to print a 404 page instead of an error message if the $id is not found.*/
        $post = Post::findOrFail($id);


        return view( 'posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = Post::findOrFail($id); 
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = Str::slug($request->input('content'), '-');

        $post->save();

        $request->session()->flash('status', 'post was created!!');

        //return redirect('/posts');  <=>  return redirect()->route('posts.index');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request$request, $id)
    {
        /**** the first way to delete an entry from the db
        $post = Post::findOrFail($id); 
        $post->delete();
        */

        //the second way to delete an entry from the db 
        Post::destroy($id);


        $request->session()->flash('status', 'The post was deleted!!');

        //return redirect('/posts');  <=>  return redirect()->route('posts.index');
        return redirect()->route('posts.index');
    }
}
