<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * QuestionController | Api
 */
class QuestionController extends Controller
{

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $questions = Question::paginate(10);
        return QuestionResource::collection($questions);
    }


    /**
     * @param QuestionStoreRequest $request
     * @return QuestionResource
     */
    public function store(QuestionStoreRequest $request): QuestionResource
    {
        $data = $request->validated();
        $question = Question::create($data);
        return new QuestionResource($question);
    }


    /**
     * @param Question $question
     * @return QuestionResource
     */
    public function show(Question $question): QuestionResource
    {
        return new QuestionResource($question);
    }


    /**
     * @param QuestionUpdateRequest $request
     * @param Question $question
     * @return QuestionResource
     */
    public function update(QuestionUpdateRequest $request, Question $question): QuestionResource
    {
        $data = $request->validated();
        $question->update($data);
        return new QuestionResource($question);
    }


    /**
     * @param Question $question
     * @return Response
     */
    public function destroy(Question $question): Response
    {
        $question->delete();
        return response()->noContent();
    }
}
