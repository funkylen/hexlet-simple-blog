<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SimpleAuth;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(SimpleAuth::class)->except('index', 'show');
    }

    public function index()
    {
        $posts = DB::table('posts')->orderBy('id')->paginate(3);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        $id = DB::table('posts')->insertGetId([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]);

        return redirect()->route('posts.show', $id);
    }

    public function show($id)
    {
        $post = DB::table('posts')->find($id);

        if (!$post) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = DB::table('posts')->find($id);

        if (!$post) {
            abort(404);
        }

        return view('posts.edit', compact('post'));
    }

    public function update($id, PostUpdateRequest $request)
    {
        $post = DB::table('posts')->find($id);

        if (!$post) {
            abort(404);
        }

        DB::table('posts')->where('id', $post->id)->update($request->validated());

        return redirect()->route('posts.show', $id);
    }

    public function destroy($id)
    {
        $post = DB::table('posts')->find($id);

        if (!$post) {
            abort(404);
        }

        DB::table('posts')->where('id', $post->id)->delete();

        return redirect()->route('posts.index');
    }
}
