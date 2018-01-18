<?php

namespace Jobinja\Utils\JsonResponse\Responses;

use Jobinja\Utils\JsonResponse\BaseResponse;
use Jobinja\Utils\JsonResponse\Response;
use Jobinja\Utils\JsonResponse\ResponseStatusCode;

final class ValidationResponse extends BaseResponse implements Response
{
    public function __construct(array $errors)
    {
        parent::__construct($errors, [], 'Validation Error', []);
    }


    public function getCode()
    {
        return ResponseStatusCode::HTTP_UNPROCESSABLE_ENTITY;
    }
}
