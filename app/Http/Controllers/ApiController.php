<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;

class ApiController extends Controller
{
    

    public function success($data, string $message = null, int $code = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }
    
    public function error($data, string $message = null, int $code)
    {
        // dd($code);
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
