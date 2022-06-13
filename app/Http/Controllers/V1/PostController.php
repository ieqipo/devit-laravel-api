<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use http\Env\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @OA\Get(
     *      path="/posts",
     *      operationId="getPostsList",
     *      tags={"Posts"},
     *      summary="Get list of posts",
     *      description="Returns list of posts",
     *     @OA\Parameter(
     *          name="page",
     *          description="The page number",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PostResource")

     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     *     )
     */
    public function index()
    {
        $posts = Post::paginate('10');
        return PostResource::collection($posts);
    }

    /**
     * @OA\Post(
     *      path="/posts",
     *      operationId="storePost",
     *      tags={"Posts"},
     *      summary="Store new post",
     *      description="Returns post data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePostRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PostResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());

        return new PostResource($post);
    }

    /**
     * @OA\Get(
     *      path="/posts/{id}",
     *      operationId="getPostById",
     *      tags={"Posts"},
     *      summary="Get post information",
     *      description="Returns post data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PostResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     * )
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * @OA\Put(
     *      path="/posts/{id}",
     *      operationId="updatePost",
     *      tags={"Posts"},
     *      summary="Update existing post",
     *      description="Returns updated post data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePostRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PostResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());

        return new PostResource($post);
    }

    /**
     * @OA\Delete(
     *      path="/posts/{id}",
     *      operationId="deletePost",
     *      tags={"Posts"},
     *      summary="Delete existing post",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response(null, 204);
    }
}
