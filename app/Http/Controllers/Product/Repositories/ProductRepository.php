<?php

namespace App\Http\Controllers\Product\Repositories;

use App\Http\Controllers\Product\Contracts\ProductInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductInterface
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return Collection|Product[]
     */
    public function index()
    {
        return $this->product->all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        return $this->product->create($request)->id;
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
        return $this->product
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
