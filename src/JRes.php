<?php

namespace Jobinja\Utils\JsonResponse;

use Illuminate\Validation\ValidationException;
use Jobinja\Utils\JsonResponse\Responses\DestroyResponse;
use Jobinja\Utils\JsonResponse\Responses\ErrorResponse;
use Jobinja\Utils\JsonResponse\Responses\IndexResponse;
use Jobinja\Utils\JsonResponse\Responses\PaginationResponse;
use Jobinja\Utils\JsonResponse\Responses\StoreResponse;
use Jobinja\Utils\JsonResponse\Responses\UpdateResponse;
use Jobinja\Utils\JsonResponse\Responses\ValidationResponse;
use Jobinja\Utils\Misc\ApplicationValidationException;
use Jobinja\Utils\Misc\DomainException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class JRes
{
    public static function validation(array $errors)
    {
        return new ValidationResponse($errors);
    }

    public static function store(array $data)
    {
        return new StoreResponse($data);
    }

    public static function index(array $data)
    {
        return new IndexResponse($data);
    }

    public static function update(array $data = [])
    {
        return new UpdateResponse($data);
    }

    public static function destroy(array $data = [])
    {
        return new DestroyResponse($data);
    }

    public static function error($message, $errorCode = 422)
    {
        return new ErrorResponse($message, $errorCode);
    }

    /**
     * @param \Exception $e
     * @param null $translationPrefix
     * @return ErrorResponse|ValidationResponse
     * @throws \Exception
     */
    public static function errorException(\Exception $e, $translationPrefix = null)
    {
        if (class_exists(ApplicationValidationException::class) && $e instanceof ApplicationValidationException) {
            return new ValidationResponse($e->getErrors());
        }

        if ($e instanceof ValidationException) {
            return new ValidationResponse($e->errors());
        }

        $message = $e->getMessage();

        if (empty($message) || $message === null) {
            $message = trans($translationPrefix  ? $translationPrefix .  '.' : 'exceptions.'.snake_case(class_basename($e)));
        }

        if ($e instanceof HttpExceptionInterface) {
            $code = $e->getStatusCode();
        } elseif (class_exists(DomainException::class) && $e instanceof DomainException) {
            $code = 400;
        } else {
            throw $e;
        }

        return new ErrorResponse($message, $code);
    }

    public static function pagination($paginator)
    {
        return new PaginationResponse($paginator);
    }
}
