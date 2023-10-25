<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the latest post
        $latestPost = BlogPost::latest()->first();

        // Retrieve all posts except the latest one
        $posts = BlogPost::where('id', '!=', $latestPost->id)->latest()->get();

        $posts = BlogPost::latest()->paginate(7); // Replace 5 with the number of items per page you want to display.

        return view('index', compact('latestPost', 'posts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data (title, body, etc.) as usual
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            // Add validation rules for other fields
        ]);

        // Create a new blog post
        $blogPost = new BlogPost;
        $blogPost->title = $validatedData['title'];
        $blogPost->body = $validatedData['body'];
        // Set other fields as needed

        // Save the blog post
        $blogPost->save();

        // Attach the selected tags to the blog post
        if ($request->tags) {
            $blogPost->tags()->attach($request->tags); // Assuming you have defined a tags relationship in your BlogPost model
        }

        // Redirect to a success page or return a response
    }


    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogPost)
    {
        return view('blog.singlepost', [
            'post' => $blogPost,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost)
    {
        return view('blog.edit', [
            'post'=> $blogPost,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect('blog/' . $blogPost->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect('/blog')->with('success','Post Removed');
    }
}
