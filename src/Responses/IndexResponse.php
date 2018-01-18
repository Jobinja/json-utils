<?php

namespace Jobinja\Utils\JsonResponse\Responses;

use Jobinja\Utils\JsonResponse\BaseResponse;
use Jobinja\Utils\JsonResponse\Response;
use Jobinja\Utils\JsonResponse\ResponseStatusCode;

final class IndexResponse extends BaseResponse implements Response
{
    public function getCode()
    {
        return ResponseStatusCode::HTTP_OK;
    }

    public function __construct(array $mainData)
    {
        parent::__construct($mainData, [], 'Found', []);
    }
}
