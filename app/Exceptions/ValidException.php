<?php


namespace App\Exceptions;


use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;
use Throwable;

class ValidException extends Exception
{
    private $data;

    #[Pure] public function __construct($message = "", $data = null, $code = 0, Throwable $previous = null)
    {
        $this->data = $data;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return mixed|null
     */
    public function getData(): mixed
    {
        return $this->data;
    }

        /**
     * Report the exception.
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     * @param Request
     * @return JsonResponse
     */
    public function render($request): JsonResponse
    {
        return response()->json(
            new JsonAnswer(
                $this->getCode(),
                $this->getMessage(),
                $this->getData()
            ),
            500);
    }

}