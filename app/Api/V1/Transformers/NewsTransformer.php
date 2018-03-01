<?php

namespace App\Api\V1\Transformers;
use App\Models\News;
use League\Fractal\TransformerAbstract;

class NewsTransformer extends TransformerAbstract
{
    /**
     * 分开是为了解耦
     * 数据字段选择
     * @param $item
     * @return $array
     */
    public function transform(News $item)
    {
        /* 隐藏数据库字段 */
        return [
            'id' => $item['id'],
            'title' => $item['title'],
            'created_at' => $item['created_at'],
            'hits' => $item['hits'],
            'channel' => $item->channel->name,
            'hot' => $item['hot'],
        ];
    }
}