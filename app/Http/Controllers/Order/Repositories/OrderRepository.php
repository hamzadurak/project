<?php

namespace App\Http\Controllers\Order\Repositories;

use App\Http\Controllers\Order\Contracts\OrderInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderInterface
{
    /**
     * @var Order
     */
    private $order;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Collection|Order[]
     */
    public function index()
    {
        return $this->order->all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        return $this->order->create($request)->id;
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
        return $this->order
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
