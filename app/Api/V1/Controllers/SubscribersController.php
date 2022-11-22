<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriberCreateRequest;
use App\Http\Requests\SubscriberUpdateRequest;
use App\Models\Subscriber;
use App\Repositories\Interfaces\SubscriberRepository;
use App\Validators\SubscriberValidator;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Throwable;

/**
 * Class SubscribersController.
 *
 * @package namespace App\Api\V1\Controllers;
 */
class SubscribersController extends Controller
{
    /**
     * @var SubscriberRepository
     */
    protected SubscriberRepository $repository;

    /**
     * @var SubscriberValidator
     */
    protected SubscriberValidator $validator;

    /**
     * SubscribersController constructor.
     *
     * @param SubscriberRepository $repository
     * @param SubscriberValidator  $validator
     */
    public function __construct(SubscriberRepository $repository, SubscriberValidator $validator)
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
            $subscribers = $this->repository->all();

            return response()->json([
                'data' => $subscribers,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SubscriberCreateRequest $request
     *
     * @return JsonResponse
     *
     * @throws ValidatorException
     */
    public function store(SubscriberCreateRequest $request): JsonResponse
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $subscriber = $this->repository->create($request->all());

            $response = [
                'message' => 'Subscriber created.',
                'data' => $subscriber->toArray(),
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag(),
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Subscriber $subscriber
     *
     * @return JsonResponse
     */
    public function show(Subscriber $subscriber): JsonResponse
    {
        try {
            $subscriber = $this->repository->find($subscriber->id);

            return response()->json([
                'data' => $subscriber,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SubscriberUpdateRequest $request
     * @param Subscriber              $subscriber
     *
     * @return JsonResponse
     *
     */
    public function update(SubscriberUpdateRequest $request, Subscriber $subscriber): JsonResponse
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $subscriber = $this->repository->update($request->validated(), $subscriber->id);

            $response = [
                'message' => 'Subscriber updated.',
                'data' => $subscriber->toArray(),
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {

            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag(),
            ]);
        } catch (Throwable $e) {

            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Subscriber $subscriber
     *
     * @return JsonResponse
     */
    public function destroy(Subscriber $subscriber): JsonResponse
    {
        try {
            $deleted = $this->repository->delete($subscriber->id);

            return response()->json([
                'message' => 'Subscriber deleted.',
                'deleted' => $deleted,
            ]);
        } catch (Throwable $e) {

            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
