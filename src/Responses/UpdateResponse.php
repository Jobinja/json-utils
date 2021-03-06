<?php

namespace Jobinja\Utils\JsonResponse\Responses;

use Jobinja\Utils\JsonResponse\BaseResponse;
use Jobinja\Utils\JsonResponse\Response;
use Jobinja\Utils\JsonResponse\ResponseStatusCode;

final class UpdateResponse extends BaseResponse implements Response
{
    public function getCode()
    {
        if (empty($this->mainData) && empty($this->extraData)) {
            return ResponseStatusCode::HTTP_NO_CONTENT;
        }

        return ResponseStatusCode::HTTP_OK;
    }

    public function __construct(array $mainData = [])
    {
        parent::__construct($mainData, [], 'Updated successfully', []);
    }
}
