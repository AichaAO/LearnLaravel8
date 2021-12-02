<?php

namespace Tests\Feature;
use Illuminate\Support\Str;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSavePost()
    {

        $post = new Post();

        $post->title = "new Title to test";
        $post->slug = Str::slug($post->title, '-');
        $post->content = "new content";
        $post->active = true;
        $post->save();

        $this->assertDatabaseHas('posts', [
            'title' => 'new Title to test'
        ]);

    }


    public function testPostStoreValid() {
        $data= [
            'title' => 'test our post store test',
            'slug' => Str::slug('test our post store test', '-'),
            'content' => 'content store',
            'active' => false

        ];

        $this->post('/posts', $data)
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'post was created!!') ;

    }

    public function testPostStoreFail() {

        $data= [ 
            'title' => '',
            'content' => '', 

        ];


        $this->post('/posts', $data)
        ->assertStatus(302)
        ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();
         
        $this-> assertEquals($messages['title'][0], 'The title field is required.' );
        $this-> assertEquals($messages['content'][0], 'The content field is required.' );
 
    }


    public function testPostUpdate()
    {

        $post = new Post();

        $post->title = "second Title to test";
        $post->slug = Str::slug("second Title to test", '-');
        $post->content = "new content";
        $post->active = false;
        $post->save ();

        $this->assertDatabaseHas('posts', $post->toArray());
        $data= [
            'title' => 'test our post is updated',
            'slug' => Str::slug('test our post is updated', '-'),
            'content' => 'content store',
            'active' => false 
        ];


        $this->put("posts/{$post->id}", $data)
        ->assertStatus(302)
        ->assertSessionHas('status');


        $this -> assertDatabaseHas('posts', ['title'=>$data['title']]);

    }


    public function testPostDelete() {

        $post = new Post();

        $post->title = "second Title to test";
        $post->slug = Str::slug("second Title to test", '-');
        $post->content = "new content";
        $post->active = false;
        $post->save ();

        $this->assertDatabaseHas('posts', $post->toArray());

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertDatabaseMissing('posts',$post->toArray());


        

    }



}
