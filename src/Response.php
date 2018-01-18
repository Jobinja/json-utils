<?php

namespace Jobinja\Utils\JsonResponse;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;

/**
 * Interface Response
 * @package Jobinja\Utils\src
 */
interface Response extends Arrayable
{
    /**
     * @return int
     */
    public function getCode();

    /**
     * @param $key
     * @param $value
     * @return Response
     */
    public function addHeader($key, $value);

    /**
     * @param $key
     * @param $value
     * @return Response
     */
    public function addExtraData($key, $value);

    /**
     * @param $key
     * @param $value
     * @return Response
     */
    public function addMainData($key, $value);

    /**
     * @param array $headers
     * @return Response
     */
    public function withHeaders(array $headers);

    /**
     * @param array $extraData
     * @return Response
     */
    public function withExtraData(array $extraData);

    /**
     * @param array $mainData
     * @return Response
     */
    public function withMainData(array $mainData);

    /**
     * @return JsonResponse
     */
    public function getResponse();
}
