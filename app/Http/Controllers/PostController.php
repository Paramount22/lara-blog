<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('listPosts', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
           'posts' => Post::latest()->paginate(10)
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function listPosts()
    {
        return view('posts.listPosts', [
           'posts' => Post::latest()->with('tags', 'user')->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
            'categories' => Category::orderBy('name', 'asc')->get(),
            'tags' => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        //dd($request->all());
        if ( $request->hasFile('file') ) {
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);

          $post =  auth()->user()->posts()->create([
                'title' => $request->title,
                'body' => $request->body,
                'category_id' => $request->category,
                'file' => $name
            ]);

          $post->tags()->sync( $request->tags ? : [] );

        } else {
            $post =  auth()->user()->posts()->create([
                'title' => $request->title,
                'body' => $request->body,
                'category_id' => $request->category,
            ]);
            $post->tags()->sync( $request->get('tags') ? : [] );
        }
        return redirect()->route('posts.index')->with('success', 'Post created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ])->with('title', $post->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $selected_tags = [];
        foreach ($post->tags as $post_tag) {
            array_push($selected_tags, $post_tag->id);
        }

        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::orderBy('name', 'asc')->get(),
            'tags' => Tag::all(),
            'selected_tags' => $selected_tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        // handle image
        $name = $post->file;
        if( $request->hasFile('file')) {
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }

        $post->tags()->sync( $request->get('tags') ?: [] );

        // updated
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category;
        $post->file = $name;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        if ($post->file) {
            unlink(public_path('/images/'.$post->file)); // remove image
        }
        return redirect()->route('posts.index')->with('success', 'Post deleted.');
    }
}
