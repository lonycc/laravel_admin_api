<?php

namespace App\Api\V1\Transformers;
use App\Models\Award;
use League\Fractal\TransformerAbstract;

class AwardTransformer extends TransformerAbstract
{
    /**
     * 分开是为了解耦
     * 数据字段选择
     * @param $litem
     * @return $array
     */
    public function transform(Award $item)
    {
        /* 隐藏数据库字段 */
        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'info' => $item['info'],
            'count' => $item['score'],
        ];
    }
}