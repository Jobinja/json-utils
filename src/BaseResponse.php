<?php

namespace Jobinja\Utils\JsonResponse;

use Illuminate\Http\JsonResponse;

abstract class BaseResponse implements Response
{
    /**
     * @var array
     */
    protected $mainData;

    /**
     * @var array
     */
    protected $extraData;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var array
     */
    protected $headers;

    public function __construct(array $mainData, array $extraData, $message = null, array $headers = [])
    {
        $this->mainData = $mainData;
        $this->extraData = $extraData;
        $this->message = $message;
        $this->headers = $headers;
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;

        return $this;
    }

    public function withHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    public function withExtraData(array $extraData)
    {
        $this->extraData = $extraData;

        return $this;
    }

    public function withMainData(array $mainData)
    {
        $this->mainData = $mainData;

        return $this;
    }

    public function addMainData($key, $value)
    {
        $this->mainData[$key] = $value;

        return $this;
    }

    public function addExtraData($key, $value)
    {
        $this->extraData[$key] = $value;

        return $this;
    }

    public function toArray()
    {
        $array = [];

        if (!empty($this->message) && $this->message !== null) {
            $array['message'] = $this->message;
        }

        if (!empty($this->mainData)) {
            $array['data'] = $this->mainData;
        }

        if (!empty($this->extraData)) {
            $array['extra'] = $this->extraData;
        }

        return $array;
    }

    public function getCode()
    {
        throw new \RuntimeException('Response http code required');
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function withMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getResponse()
    {
        return new JsonResponse(
            $this->toArray(),
            $this->getCode(),
            $this->getHeaders()
        );
    }

    public function __invoke()
    {
        return $this->getResponse();
    }

    public function __toString()
    {
        return $this->getResponse();
    }
}
