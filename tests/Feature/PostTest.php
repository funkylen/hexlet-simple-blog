<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testPostsPage(): void
    {
        $response = $this->get(route('posts.index'));

        $response->assertOk();
    }

    public function testCreatePostPage(): void
    {
        $this->authorized();

        $response = $this->get(route('posts.create'));

        $response->assertOk();
    }

    public function testCreatePost(): void
    {
        $this->authorized();

        $body = [
            'title' => 'Title',
            'content' => 'Content',
        ];

        $response = $this->post(route('posts.store'), $body);

        $response->assertRedirect();

        $this->assertDatabaseHas('posts', $body);
    }

    public function testShowPostPage(): void
    {
        $id = DB::table('posts')->insertGetId([
            'title' => 'Title',
            'content' => 'Content',
        ]);

        $response = $this->get(route('posts.show', $id));

        $response->assertOk();
    }

    public function testShowPostPageNotFound(): void
    {
        $response = $this->get(route('posts.show', 10));

        $response->assertNotFound();
    }

    public function testEditPostPage(): void
    {
        $this->authorized();

        $id = DB::table('posts')->insertGetId([
            'title' => 'Title',
            'content' => 'Content',
        ]);

        $response = $this->get(route('posts.edit', $id));

        $response->assertOk();
    }

    public function testUpdatePost(): void
    {
        $this->authorized();

        $id = DB::table('posts')->insertGetId([
            'title' => 'Title',
            'content' => 'Content',
        ]);

        $body = [
            'title' => 'Another title',
            'content' => 'Another Content',
        ];

        $response = $this->put(route('posts.update', $id), $body);

        $response->assertRedirect();

        $this->assertDatabaseHas('posts',
            [
                'id' => $id,
                ...$body,
            ]
        );
    }

    public function testDeletePost(): void
    {
        $this->authorized();

        $id = DB::table('posts')->insertGetId([
            'title' => 'Title',
            'content' => 'Content',
        ]);

        $response = $this->delete(route('posts.destroy', $id));

        $response->assertRedirect();

        $this->assertDatabaseMissing('posts', ['id' => $id]);
    }

    public function testCreatePostUnauthorized(): void
    {
        $response = $this->get(route('posts.create'));

        $response->assertRedirect();
    }
}
