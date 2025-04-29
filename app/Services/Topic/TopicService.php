<?php

namespace App\Services\Topic;

use App\Models\Topic;

class TopicService
{
    public function __construct()
    {
        //
    }

    public function index(): object
    {
        return Topic::orderBy('chapter_id', 'asc')
            ->orderBy('topic_order', 'asc')
            ->get();
    }

    public function store(array $data): object
    {
        return Topic::create($data);
    }

    public function update(array $data, Topic $topic): bool
    {
        return $topic->update($data);
    }

    public function softDelete(Topic $topic): bool
    {
        return $topic->delete();
    }
}
