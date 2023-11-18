<?php


namespace App\Http\Controllers\Offer\Services;

use App\Http\Controllers\Offer\Contracts\OfferInterface;
use Illuminate\Support\Facades\DB;

class OfferService
{
    /**
     * @var OfferInterface
     */
    private $repository;

    /**
     * @param OfferInterface $repository
     */
    public function __construct(OfferInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $offers = $this->repository->index();
        $products = [];
        foreach ($offers as $item) {
            $product=$item->product;
            $products[] = [
                'id' => $product->id,
                'name' => $product->name,
            ];
        }
        return [
            'offers' => $offers,
            'products' => $products,
        ];
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            return $this->repository->store($request);
        });
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->repository->show($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->repository->edit($id);
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            return $this->repository->update($request, $id);
        });
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            return $this->repository->destroy($id);
        });
    }
}
