<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\TestTransformer;
use App\Api\V1\Models\User;

class TestController extends BaseController
{
    // 获取全部用户
    public function index()
    {
        $test = User::all();
        return $this->collection($test, new TestTransformer());
    }

    // 获取指定用户
    public function show($id)
    {
        $test = User::find($id);
        if ( ! $test ) {
            return $this->response->errorNotFound('Test not found');
        }
        return $this->item($test, new TestTransformer());
    }

}