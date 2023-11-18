<?php

namespace App\Http\Controllers\Offer\Controllers;

use App\Enumerations\Offers\AvailabilityEnum;
use App\Enumerations\Offers\ConditionEnum;
use App\Helpers\RedirectHelper;
use App\Http\Controllers\Offer\Collections\OfferCollection;
use App\Http\Controllers\Offer\Resources\OfferResource;
use App\Http\Controllers\Offer\Services\OfferService;
use App\Http\Requests\Offer\OfferStoreRequest;
use App\Http\Requests\Offer\OfferUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class OfferController extends Controller
{
    /**
     * @var OfferService
     */
    private $service;

    /**
     * @param OfferService $service
     */
    public function __construct(OfferService $service)
    {
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function index(): array
    {
        $result = $this->service->index();
        return [
            'data' => OfferCollection::make($result['offers']),
            'statuses' => [
                'condition' => [
                    ConditionEnum::NEW,
                    ConditionEnum::USED,
                ],
                'availability' => [
                    AvailabilityEnum::OUT_OF_STOCK,
                    AvailabilityEnum::IN_STOCK,
                ],
                'product' => $result['products']
            ]
        ];
    }

    /**
     * @return array
     */
    public function create(): array
    {
        return [
            'statuses' => [
                'condition' => [
                    ConditionEnum::NEW,
                    ConditionEnum::USED,
                ],
                'availability' => [
                    AvailabilityEnum::OUT_OF_STOCK,
                    AvailabilityEnum::IN_STOCK,
                ],
            ]
        ];
    }

    /**
     * @param OfferStoreRequest $request
     * @return JsonResponse|object
     */
    public function store(OfferStoreRequest $request)
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
            'data' => OfferResource::make($this->service->edit($id)),
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function edit($id): array
    {
        return [
            'data' => OfferResource::make($this->service->edit($id)),
        ];
    }

    /**
     * @param OfferUpdateRequest $request
     * @param $id
     * @return JsonResponse|object
     */
    public function update(OfferUpdateRequest $request, $id)
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
