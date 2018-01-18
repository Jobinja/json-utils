<?php

namespace Jobinja\Utils\JsonResponse\Responses;

use Illuminate\Contracts\Pagination\Paginator;
use Jobinja\Utils\JsonResponse\BaseResponse;
use Jobinja\Utils\JsonResponse\ResponseStatusCode;
use Jobinja\Utils\LengthAwarePaginator;

final class PaginationResponse extends BaseResponse
{
    /**
     * @var Paginator|LengthAwarePaginator
     */
    private $paginator;

    public function getCode()
    {
        return ResponseStatusCode::HTTP_OK;
    }

    public function __construct(Paginator $paginator)
    {
        parent::__construct([], [], null, []);
        $this->paginator = $paginator;
    }

    public function withMainData(array $mainData)
    {
        throw new \BadMethodCallException(sprintf('%s has not mainData setter', get_called_class()));
    }

    public function toArray()
    {
        $array = [];

        if (!empty($this->message) && $this->message !== null) {
            $array['message'] = $this->message;
        }

        if ($this->paginator !== null) {
            $array['data'] = $this->paginator->items();
            $array['pagination_meta'] = [
                'total' => $this->paginator->total(),
                'current_page' => $this->paginator->currentPage(),
                'last_page' => $this->paginator->lastPage(),
                'next_page_url' => $this->paginator->nextPageUrl(),
                'previous_page_url' => $this->paginator->previousPageUrl(),
                'per_page' => $this->paginator->perPage(),
            ];
        }

        if (!empty($this->extraData)) {
            $array['extra'] = $this->extraData;
        }

        return $array;
    }
}
