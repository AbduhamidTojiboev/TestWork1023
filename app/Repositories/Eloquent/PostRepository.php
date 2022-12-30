<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Contract\PostRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends BaseRepository implements PostRepositoryContract
{
    /**
     * PostRepository constructor
     *
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }
}
