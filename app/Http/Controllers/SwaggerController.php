<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Swagger API",
 *     description="API Documentation for Swagger API", )
 */

class SwaggerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/example",
     *     summary="Example endpoint",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function example()
    {
        return response()->json(['message' => 'This is an example']);
    }
}
