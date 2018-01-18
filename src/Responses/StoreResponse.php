<?php

namespace Jobinja\Utils\JsonResponse\Responses;

use Jobinja\Utils\JsonResponse\BaseResponse;
use Jobinja\Utils\JsonResponse\Response;
use Jobinja\Utils\JsonResponse\ResponseStatusCode;

final class StoreResponse extends BaseResponse implements Response
{
    public function __construct(array $mainData)
    {
        parent::__construct($mainData, [], 'Created', []);
    }

    public function getCode()
    {
        return ResponseStatusCode::HTTP_CREATED;
    }
}
