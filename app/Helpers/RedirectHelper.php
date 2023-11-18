<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class RedirectHelper
{
    /**
     * Returns record result
     *
     * @param array $parameters
     * @param null $message
     * @return JsonResponse|object
     */
    public static function store(array $parameters = [], $message = null)
    {
        return self::result(200, $message ?? 'Successfully Created', $parameters);
    }

    /**
     * Returns the update result
     *
     * @param array $parameters
     * @param null $message
     * @return JsonResponse|object
     */
    public static function update(array $parameters = [], $message = null)
    {
        return self::result(200, $message ?? 'Successfully Updated', $parameters);
    }

    /**
     * Returns the deletion result
     *
     * @param array $parameters
     * @param null $message
     * @return JsonResponse|object
     */
    public static function destroy(array $parameters = [], $message = null)
    {
        return self::result(200, $message ?? 'Successfully Deleted', $parameters);
    }

    /**
     * Returns successful result
     *
     * @param array $parameters
     * @param null $message
     * @return JsonResponse|object
     */
    public static function success(array $parameters = [], $message = null)
    {
        return self::result(200, $message ?? 'Successfully', $parameters);
    }

    /**
     * Returns error result
     *
     * @param array $parameters
     * @param null $message
     * @param int $statusCode
     * @return JsonResponse|object
     */
    public static function error(int $statusCode = 422, $message = null, array $parameters = [])
    {
        return self::result($statusCode, $message ?? 'Something went wrong', $parameters);
    }

    /**
     * Formats the result and returns
     *
     * @param int $statusCode
     * @param $message
     * @param null $data
     * @return JsonResponse|object
     */
    public static function result($statusCode = 200, $message, $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ])->setStatusCode($statusCode);
    }
}
