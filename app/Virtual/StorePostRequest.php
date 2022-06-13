<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Store Post request",
 *      description="Store Post request body data",
 *      type="object",
 *      required={"title"}
 * )
 */
class StorePostRequest
{
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
