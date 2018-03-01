<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;

class TestTransformer extends TransformerAbstract
{
    /**
     * 分开是为了解耦
     * 数据字段选择
     * @param $item
     * @return $array
     */
    public function transform($item)
    {
        /* 隐藏数据库字段 */
        return [
            'name' => $item['name'],
            'email' => $item['email'],
        ];
    }
}