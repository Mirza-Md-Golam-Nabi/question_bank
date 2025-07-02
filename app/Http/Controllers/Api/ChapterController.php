<?php

namespace App\Http\Controllers\Api;

use App\Models\Chapter;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Chapter\ChapterService;
use App\Http\Requests\Chapter\ChapterRequest;
use App\Http\Requests\Chapter\StoreChapterRequest;
use App\Http\Requests\Chapter\UpdateChapterRequest;

class ChapterController extends Controller
{
    protected $chapter;

    public function __construct()
    {
        $this->chapter = new ChapterService();
    }

    public function index(ChapterRequest $request): JsonResponse
    {
        $subject_id = $request->subject_id;

        $chapters = $this->chapter->index($subject_id);

        return formatResponse(0, 200, 'Success', $chapters);
    }

    public function store(StoreChapterRequest $request): JsonResponse
    {
        $chapter = $this->chapter->store($request->validated());

        return formatResponse(0, 200, 'Success', $chapter);
    }

    public function show(Chapter $chapter): JsonResponse
    {
        return formatResponse(0, 200, 'Success', $chapter);
    }

    public function update(UpdateChapterRequest $request, Chapter $chapter): JsonResponse
    {
        $this->chapter->update($request->validated(), $chapter);

        return formatResponse(0, 200, 'Success', $chapter->refresh());
    }

    public function destroy(Chapter $chapter): JsonResponse
    {
        $subject_id = $chapter->subject_id;

        $this->chapter->softDelete($chapter);

        $request = $this->customChapterRequest($subject_id);

        return $this->index($request);
    }

    protected function customChapterRequest(int $subject_id)
    {
        $request = new ChapterRequest();

        return $request->merge([
            'subject_id' => $subject_id
        ]);
    }
}
