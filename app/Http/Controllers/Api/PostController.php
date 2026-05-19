<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * GET /api/posts
     * List all published posts (paginated).
     */
    public function index(Request $request)
    {
        $posts = Post::published()
            ->with('user')
            ->withCount('comments')
            ->latest('published_at')
            ->paginate(10);

        return view('index',['posts'=>$posts]);
    }

    /**
     * POST /api/posts
     * Create a new post.
     */
    public function store(StorePostRequest $request): PostResource
    {
        $data = $request->validated();
        $data['user_id']      = Auth::id();
        $data['slug']         = Str::slug($data['title']) . '-' . Str::random(6);
        $data['published_at'] = $data['published'] ?? false ? now() : null;

        $post = Post::create($data);
        $post->load('user');

        return (new PostResource($post))
            ->response()
            ->setStatusCode(201)
            ->getData(true);
    }

    /**
     * GET /api/posts/{post}
     * Show a single post with comments.
     */
    public function show(Post $post)
    {
        abort_if(! $post->published && $post->user_id !== Auth::id(), 404);

        $post->load(['user', 'comments.user']);
        $post->loadCount('comments');

       return view('blog-detail',['detail'=>new PostResource($post)]);
    }

    public function showAll(){

      $posts = Post::published()
            ->with('user')
            ->withCount('comments')
            ->latest('published_at')
            ->paginate(10);

        return view('all_blogs',['posts'=>$posts]);
    }
    /**
     * PUT /api/posts/{post}
     * Update a post (owner only).
     */
    public function update(UpdatePostRequest $request, Post $post): PostResource
    {
        $this->authorizeOwner($post);

        $data = $request->validated();

        if (isset($data['published']) && $data['published'] && ! $post->published) {
            $data['published_at'] = now();
        }

        $post->update($data);
        $post->load('user');

        return new PostResource($post);
    }

    /**
     * DELETE /api/posts/{post}
     * Delete a post (owner only).
     */
    public function destroy(Post $post): JsonResponse
    {
        $this->authorizeOwner($post);

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully.']);
    }

    // ─── Helpers ──────────────────────────────────────────
    private function authorizeOwner(Post $post): void
    {
        abort_if($post->user_id !== Auth::id(), 403, 'You do not own this post.');
    }
}
