<?php

namespace App\Http\Controllers\Api;

use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Topic\TopicService;
use App\Http\Requests\Topic\TopicRequest;
use App\Http\Requests\Topic\StoreTopicRequest;
use App\Http\Requests\Topic\UpdateTopicRequest;

class TopicController extends Controller
{
    protected $topic;

    public function __construct()
    {
        $this->topic = new TopicService();
    }

    public function index(TopicRequest $request): JsonResponse
    {
        $chapter_id = $request->chapter_id;

        $topics = $this->topic->index($chapter_id);

        return formatResponse(0, 200, 'Success', $topics);
    }

    public function store(StoreTopicRequest $request): JsonResponse
    {
        $topic = $this->topic->store($request->validated());

        return formatResponse(0, 200, 'Success', $topic);
    }

    public function show(Topic $topic): JsonResponse
    {
        return formatResponse(0, 200, 'Success', $topic);
    }

    public function update(UpdateTopicRequest $request, Topic $topic): JsonResponse
    {
        $this->topic->update($request->validated(), $topic);

        return formatResponse(0, 200, 'Success', $topic->refresh());
    }

    public function destroy(Topic $topic): JsonResponse
    {
        $chapter_id = $topic->chapter_id;

        $this->topic->softDelete($topic);

        $request = $this->customTopicRequest($chapter_id);

        return $this->index($request);
    }

    protected function customTopicRequest(int $chapter_id)
    {
        $request = new TopicRequest();

        return $request->merge([
            'chapter_id' => $chapter_id
        ]);
    }
}
