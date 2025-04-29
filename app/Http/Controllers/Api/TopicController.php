<?php

namespace App\Http\Controllers\Api;

use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Topic\TopicService;
use App\Http\Requests\Topic\StoreTopicRequest;
use App\Http\Requests\Topic\UpdateTopicRequest;

class TopicController extends Controller
{
    protected $topic;

    public function __construct()
    {
        $this->topic = new TopicService();
    }

    public function index(): JsonResponse
    {
        $topics = $this->topic->index()->load('chapter');
        return formatResponse(0, 200, 'Success', $topics);
    }

    public function store(StoreTopicRequest $request): JsonResponse
    {
        $topic = $this->topic->store($request->validated());
        return formatResponse(0, 200, 'Success', $topic);
    }

    public function show(Topic $topic): JsonResponse
    {
        return formatResponse(0, 200, 'Success', $topic->load('chapter'));
    }

    public function update(UpdateTopicRequest $request, Topic $topic): JsonResponse
    {
        $this->topic->update($request->validated(), $topic);
        return formatResponse(0, 200, 'Success', $topic->refresh());
    }

    public function destroy(Topic $topic): JsonResponse
    {
        $this->topic->softDelete($topic);
        return $this->index();
    }
}
