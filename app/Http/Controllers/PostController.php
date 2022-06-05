<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->orderBy('id')->paginate();

        return view('home', compact('posts'));
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        $id = DB::table('posts')->insertGetId([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]);

        return redirect()->route('show_post_page', $id);
    }

    public function show($id)
    {
        $post = DB::table('posts')->find($id);

        if (!$post) {
            abort(404);
        }

        return view('post.show', compact('post'));
    }

    public function edit($id)
    {
        $post = DB::table('posts')->find($id);

        if (!$post) {
            abort(404);
        }

        return view('post.edit', compact('post'));
    }

    public function update($id, PostUpdateRequest $request)
    {
        $post = DB::table('posts')->find($id);

        if (!$post) {
            abort(404);
        }

        DB::table('posts')->where('id', $post->id)->update($request->validated());

        return redirect()->route('show_post_page', $id);
    }

    public function delete($id)
    {
        $post = DB::table('posts')->find($id);

        if (!$post) {
            abort(404);
        }

        DB::table('posts')->where('id', $post->id)->delete();

        return redirect()->route('posts_page');
    }
}
