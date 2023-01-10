<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Repositories\Contract\PostRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * @param PostRepositoryContract $postRepository
     */
    public function __construct(private PostRepositoryContract $postRepository)
    {
        $this->middleware('post.can-list', ['only' => ['index']]);
        $this->middleware('post.can-show', ['only' => ['show']]);
        $this->middleware('post.can-create', ['only' => ['store']]);
        $this->middleware('post.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('post.can-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->all();

        return response()->json([
            'status' => 'success',
            'posts' => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $post = $this->postRepository->create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Post created successfully',
            'post' => $post,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $post = $this->postRepository->findById($id);

        return response()->json([
            'status' => 'success',
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $post = $this->postRepository->findById($id);

        return response()->json([
            'status' => 'success',
            'post' => $post,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  PostUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, int $id)
    {
        $post = $this->postRepository->update($id, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Post updated successfully',
            'post' => $post,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->postRepository->destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Post deleted successfully',
        ]);
    }
}
