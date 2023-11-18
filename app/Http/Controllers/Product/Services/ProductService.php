<?php


namespace App\Http\Controllers\Product\Services;

use App\Http\Controllers\Product\Contracts\ProductInterface;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * @var ProductInterface
     */
    private $repository;

    /**
     * @param ProductInterface $repository
     */
    public function __construct(ProductInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->repository->index();
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
