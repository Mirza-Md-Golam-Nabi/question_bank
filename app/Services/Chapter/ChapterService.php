<?php

namespace App\Services\Chapter;

use App\Models\Chapter;

class ChapterService
{
    public function __construct()
    {
        //
    }

    public function index(int $subject_id): object
    {
        return Chapter::where('subject_id', $subject_id)
            ->orderBy('chapter_order', 'asc')
            ->get();
    }

    public function store(array $data): object
    {
        return Chapter::create($data);
    }

    public function update(array $data, Chapter $chapter): bool
    {
        return $chapter->update($data);
    }

    public function softDelete(Chapter $chapter): bool
    {
        return $chapter->delete();
    }
}
