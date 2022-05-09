<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $tagNames = explode(',', $request->tags);

        if ($request->has('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            // $request->file('image')->storeAs('uploads', $imageName, 'public');
            $path = Storage::disk('public')->putFileAs(
                'uploads', $request->file('image'), $imageName
            );
        }

        $post = Post::create([
            'title' => $request->title,
            'text' => $request->text,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id,
            'image' => $imageName ?? null
        ]);

        // attach the tag o the post
        foreach($tagNames as $tagName){
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag);
        }

        return redirect(route('admin.posts.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        // $tags will extract only the name of the tags and concatenate them with a ,
        $tags = $post->tags->implode('name', ', ');

        return view('admin.posts.edit',compact('categories', 'tags', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        if ($request->has('image')) {
            Storage::delete('public/uploads/' . $post->image);
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('uploads', $imageName, 'public');
        }

        $post->update([
            'title' => $request->title,
            'text' => $request->text,
            'category_id' => $request->category,
            'image' => $imageName ?? $post->image
        ]);

        $tagNames = explode(', ', $request->tags);

        $tagIdArray = [];
        foreach($tagNames as $tagName){
            $tag = Tag::firstOrCreate([
                'name' => $tagName
            ]);
            array_push($tagIdArray, $tag->id);
        }

        // we sync all the tags with the post
        $post->tags()->sync($tagIdArray);

        return redirect(route('admin.posts.index'))
        ->with('status', 'Post Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // detach all tags related to this post
        $post->tags()->detach();
        $post->delete();
        return redirect(route('admin.posts.index'))
        ->with('status', 'Post Deleted.');
    }
}
