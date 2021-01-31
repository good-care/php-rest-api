<?php

namespace App\Http\Middleware;

use App\Exceptions\JsonAnswer;
use App\Exceptions\ValidException;
use Closure;
use Firebase\JWT\JWT;
use Exception;
use Illuminate\Http\Request;


class Guard
{
//    private const HEADER_VALUE_PATTERN = "/GoodCare\s+(.*)$/i";

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws ValidException
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $secretKey = env('TOKEN_KEY','secret_key');
            $jwt = $request->header('Authorization');

            $token = JWT::decode(
                $jwt,
                $secretKey,
                array('HS512')
            );
            $request->merge(['userId' => $token->data->userId]);
            return $next($request);
        }catch (Exception $e) {
            return response()->json(new JsonAnswer(
                0,
                'Invalid token: ' . $e->getMessage(),
                null,
                null
            ));
        }
    }


//    private function extractToken(Request $request): string
//    {
//        $authHeader = $request->header('Authorization');
//        if (empty($authHeader))
//            return '';
//        if (preg_match(self::HEADER_VALUE_PATTERN, $authHeader[0], $matches)) {
//            return $matches[1];
//        }
//        return "null";
//    }
}