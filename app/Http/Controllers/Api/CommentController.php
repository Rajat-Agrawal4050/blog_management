<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * GET /api/posts/{post}/comments
     * List all comments on a post.
     */
    public function index(Request $request, Post $post): CommentCollection
    {
        $comments = $post->comments()
            ->with('user')
            ->latest()
            ->paginate($request->integer('per_page', 15));

        return new CommentCollection($comments);
    }

    public function getAllComments(Request $request)
    {

        $all_comments = Comment::with('post', 'user')->latest()->get();
        return response()->json([
            'status' => true,
            'comments' => $all_comments
        ], 200);
    }

    /**
     * POST /api/posts/{post}/comments
     * Add a comment to a post.
     */
    public function store(StoreCommentRequest $request, Post $post): CommentResource
    {
        abort_if(! $post->published, 403, 'Cannot comment on an unpublished post.');

        if (!Auth::id()) abort(401, "You are not logged in.");

        $comment = $post->comments()->create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'body'    => $request->validated('msg'),
        ]);

        $comment->load('user');

        return (new CommentResource($comment));
    }

    /**
     * GET /api/comments/{comment}
     * Show a single comment.
     */
    public function show(Comment $comment): CommentResource
    {
        $comment->load('user', 'post');

        return new CommentResource($comment);
    }

    /**
     * PUT /api/comments/{comment}
     * Update a comment (owner only).
     */
    public function update(UpdateCommentRequest $request, Comment $comment): CommentResource
    {

        $text = $request->validated('text');
        $comment->update([
            'body' => $text,
        ]);
        $comment->load('user');

        return new CommentResource($comment);
    }

    /**
     * DELETE /api/comments/{comment}
     * Delete a comment (owner only).
     */
    public function destroy(Comment $comment): JsonResponse
    {

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully.']);
    }

    // ─── Helpers ──────────────────────────────────────────
    private function authorizeOwner(Comment $comment): void
    {
        abort_if($comment->user_id !== Auth::id(), 403, 'You do not own this comment.');
    }
}
