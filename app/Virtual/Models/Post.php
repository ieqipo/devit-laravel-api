<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Post",
 *     description="Post model",
 *     @OA\Xml(
 *         name="Post"
 *     )
 * )
 */
class Post
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="title",
     *      description="Title of the article",
     *      example="This is the title"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="link",
     *      description="Url of some page",
     *      example="https://localhost.com"
     * )
     *
     * @var string
     */
    public $link;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the article",
     *      example="This is the description of the article."
     * )
     *
     * @var string
     */
    public $description;

}
