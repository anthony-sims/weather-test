<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Retrieve all posts
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Post::simplePaginate(10));
    }

    /**
     * Create New Post assigned to current user
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $title = $request->input('title');
        $content = $request->input('content');
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        Post::create([
            'title' => (string)$title,
            'content' => (string)$content,
            'user_id' => $user->id,
        ]);

        return response()->json(['message' => 'Post created'], 201);
    }

    /**
     * Retrieve single post
     * 
     * @param Post $post
     * 
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json($post);   
    }

    /**
     * Update single post
     * 
     * @param Request $request
     * @param Post $post
     * 
     * @return JsonResponse
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $title = $request->input('title');
        $content = $request->input('content');

        $post->title = $title;
        $post->content = $content;
        $post->save();

        return response()->json(['message' => 'Post updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
