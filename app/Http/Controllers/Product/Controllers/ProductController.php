<?php

namespace App\Http\Controllers\Product\Controllers;

use App\Helpers\RedirectHelper;
use App\Http\Controllers\Product\Collections\ProductCollection;
use App\Http\Controllers\Product\Resources\ProductResource;
use App\Http\Controllers\Product\Services\ProductService;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $service;

    /**
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function index(): array
    {
        return [
            'data' => ProductCollection::make($this->service->index()),
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
     * @param ProductStoreRequest $request
     * @return JsonResponse|object
     */
    public function store(ProductStoreRequest $request)
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
            'data' => ProductResource::make($this->service->edit($id)),
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function edit($id): array
    {
        return [
            'data' => ProductResource::make($this->service->edit($id)),
        ];
    }

    /**
     * @param ProductUpdateRequest $request
     * @param $id
     * @return JsonResponse|object
     */
    public function update(ProductUpdateRequest $request, $id)
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
