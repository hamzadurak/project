<?php

namespace App\Http\Controllers\Order\Controllers;

use App\Helpers\RedirectHelper;
use App\Http\Controllers\Order\Collections\OrderCollection;
use App\Http\Controllers\Order\Resources\OrderResource;
use App\Http\Controllers\Order\Services\OrderService;
use App\Http\Requests\Order\OrderStoreRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $service;

    /**
     * @param OrderService $service
     */
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function index(): array
    {
        return [
            'data' => OrderCollection::make($this->service->index()),
        ];
    }

    /**
     * @return array
     */
    public function create(): array
    {
        return [];
    }

    /**
     * @param OrderStoreRequest $request
     * @return JsonResponse|object
     */
    public function store(OrderStoreRequest $request)
    {
        return RedirectHelper::store(['id' => $this->service->store($request->all())]);
    }

    /**
     * @param $id
     * @return array
     */
    public function show($id): array
    {
        return [
            'data' => OrderResource::make($this->service->edit($id)),
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function edit($id): array
    {
        return [
            'data' => OrderResource::make($this->service->edit($id)),
        ];
    }

    /**
     * @param OrderUpdateRequest $request
     * @param $id
     * @return JsonResponse|object
     */
    public function update(OrderUpdateRequest $request, $id)
    {
        if ($this->service->update($request->all(), $id)) {
            return RedirectHelper::update();
        }
        return RedirectHelper::error();
    }

    /**
     * @param $id
     * @return JsonResponse|object
     */
    public function destroy($id)
    {
        if ($this->service->destroy($id)) {
            return RedirectHelper::destroy();
        }
        return RedirectHelper::error();
    }
}
