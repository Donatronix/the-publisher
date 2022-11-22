<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicCreateRequest;
use App\Http\Requests\TopicUpdateRequest;
use App\Models\Topic;
use App\Repositories\Interfaces\TopicRepository;
use App\Validators\TopicValidator;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Throwable;

/**
 * Class TopicsController.
 *
 * @package namespace App\Api\V1\Controllers;
 */
class TopicsController extends Controller
{
    /**
     * @var TopicRepository
     */
    protected TopicRepository $repository;

    /**
     * @var TopicValidator
     */
    protected TopicValidator $validator;

    /**
     * TopicsController constructor.
     *
     * @param TopicRepository $repository
     * @param TopicValidator  $validator
     */
    public function __construct(TopicRepository $repository, TopicValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $this->repository->pushCriteria(app(RequestCriteria::class));
            $topics = $this->repository->all();

            return response()->json([
                'data' => $topics,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TopicCreateRequest $request
     *
     * @return JsonResponse
     *
     * @throws ValidatorException
     */
    public function store(TopicCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $topic = $this->repository->create($request->validated());

            $response = [
                'message' => 'Topic created.',
                'data' => $topic->toArray(),
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessageBag(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Topic $topic
     *
     * @return JsonResponse
     */
    public function show(Topic $topic): JsonResponse
    {
        try {
            $topic = $this->repository->find($topic->id);

            return response()->json([
                'data' => $topic,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TopicUpdateRequest $request
     * @param Topic              $topic
     *
     * @return JsonResponse
     *
     */
    public function update(TopicUpdateRequest $request, Topic $topic): JsonResponse
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $topic = $this->repository->update($request->validated(), $topic->id);

            $response = [
                'message' => 'Topic updated.',
                'data' => $topic->toArray(),
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessageBag(),
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Topic $topic
     *
     * @return JsonResponse
     */
    public function destroy(Topic $topic): JsonResponse
    {
        $deleted = $this->repository->delete($topic->id);

        return response()->json([
            'message' => 'Topic deleted.',
            'deleted' => $deleted,
        ]);
    }
}
