<?php

namespace Jobinja\Utils\JsonResponse\Responses;

use Jobinja\Utils\JsonResponse\BaseResponse;
use Jobinja\Utils\JsonResponse\Response;

class ErrorResponse extends BaseResponse implements Response
{
    protected $errorCode;

    public function getCode()
    {
        return $this->errorCode;
    }

    public function __construct($message, $errorCode = 422)
    {
        $this->errorCode = $errorCode;

        parent::__construct([], [], $message, []);
    }
}
