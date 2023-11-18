<?php

namespace App\Http\Controllers\Offer\Contracts;

interface OfferInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param $request
     * @return mixed
     */
    public function store($request);

    /**
     * @param $id
     * @return mixed
     */
    public function show($id);

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id);

    /**
     * @param $id
     * @param array|string[] $columns
     * @return mixed
     */
    public function getById($id, array $columns = ['*']);

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id);
}
