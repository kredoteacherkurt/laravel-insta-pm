<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $post;
    private $category;
    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $all_categories = Category::all();

        return view('users.posts.create')->with('all_categories', $all_categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


        $this->post->user_id = Auth::id();
        $this->post->description = $request->description;
        $this->post->image =  'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->post->save();

        // return $this->post;

        foreach ($request->category as $category_id) {
            $category_post[] = ["category_id" => $category_id];
        }

        return  $this->post->categoryPost()->createMany($category_post);

        return redirect()->route('index');
        //    somebody that i used to know



    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //


        return view('users.posts.show')
            ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //

        # SELECT * FROM posts WHERE id = $id;

        # If the Auth user is NOT the owner of the post, redirect to homepage
        if (Auth::user()->id != $post->user->id) {
            return redirect()->route('index');
        }

        $all_categories = $this->category->all();
        # SELECT * FROM categories;

        # Get all the category IDs of this POST. Save in an array
        $selected_categories = [];
        foreach ($post->categoryPost as $category_post) {
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.posts.edit')
            ->with('post', $post)
            ->with('all_categories', $all_categories)
            ->with('selected_categories', $selected_categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //


        # SELECT * FROM posts WHERE id = $id;

        $post->description = $request->description;

        # If there is a new image...
        if($request->image) {
            $post->image =  'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));
        }

        $post->save();

        # 3. Delete all records from category_post related to this post
        $post->categoryPost()->delete();
        # DELETE FROM category_post WHERE post_id = $post_id;
        # Use the relationship Post::categoryPost() to select the records related to a post

        # 4. Save the categories to the category_post table
        foreach($request->category as $category_id) {
            $category_post[] = ['category_id' => $category_id];
        }
        $post->categoryPost()->createMany($category_post);

        # 5. Redirect to Show Post page (to confirm the update)
        return redirect()->route('post.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        # ->forceDelete(): Permanently deletes the post, bypassing soft deletion.


        return redirect()->route('index');
    }
}
