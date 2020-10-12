<?php

namespace App\Repositories\Post;


interface PostContract
{
    public function create(array $data): array;
}