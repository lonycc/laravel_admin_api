<?php

namespace App\Api\V1\Transformers;
use App\Models\Lottery;
use League\Fractal\TransformerAbstract;

class LotteryTransformer extends TransformerAbstract
{
    /**
     * 分开是为了解耦
     * 数据字段选择
     * @param $item
     * @return $array
     */
    public function transform(Lottery $item)
    {
        /* 隐藏数据库字段 */
        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'info' => $item['info'],
        ];
    }
}