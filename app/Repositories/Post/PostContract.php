<?php

namespace App\Repositories\Post;


interface PostContract
{
    public function create(array $data): array;

    /** @param string|int $id */
    public function find($id): array;

    public function all(): array;
}