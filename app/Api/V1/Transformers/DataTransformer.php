<?php

namespace App\Api\V1\Transformers;
use App\Models\LottoData;
use League\Fractal\TransformerAbstract;

class DataTransformer extends TransformerAbstract
{
    /**
     * 分开是为了解耦
     * 数据字段选择
     * @param $item
     * @return $array
     */
    public function transform(LottoData $item)
    {
        /* 隐藏数据库字段 */
        return [
            'id' => $item['id'],
            'main' => $item['main'],
            'other' => $item['other'],
        ];
    }
}