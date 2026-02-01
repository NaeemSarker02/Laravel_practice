<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    // GET API test
    public function hello()
    {
        return response()->json([
            'status' => true,
            'message' => 'API route is working 🎉'
        ]);
    }

    // POST API test
    public function store(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => $request->all(),
            'message' => 'POST API working perfectly 🚀'
        ]);
    }
}
