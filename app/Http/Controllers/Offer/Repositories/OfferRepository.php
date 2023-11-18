<?php

namespace App\Http\Controllers\Offer\Repositories;

use App\Http\Controllers\Offer\Contracts\OfferInterface;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class OfferRepository implements OfferInterface
{
    /**
     * @var Offer
     */
    private $offer;

    /**
     * @param Offer $offer
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * @return Builder[]|Collection
     */
    public function index()
    {
        return $this->offer->with('product')->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        return $this->offer->create($request)->id;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->getById(
            $id
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->getById(
            $id
        );
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function getById($id, array $columns = ['*'])
    {
        return $this->offer
            ->select($columns)
            ->where([
                'id' => $id,
            ])
            ->firstOrFail();
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    public function update($request, $id): bool
    {
        return $this->getById($id)->update($request);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->getById($id)->delete();
    }
}
