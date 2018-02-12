<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\LotteryTransformer;
use App\Api\V1\Transformers\DataTransformer;
use App\Api\V1\Transformers\AwardTransformer;
use App\Models\Lottery;
use App\Models\Lotto;

class LotteryController extends BaseController
{
    // 获取全部项目
    public function index()
    {
        $lottery = Lottery::all();
        return $this->collection($lottery, new LotteryTransformer());
    }

    // 获取指定项目
    public function show($id)
    {
        $lottery = Lottery::find($id);
        if ( ! $lottery ) {
            return $this->response->errorNotFound('不存在的项目');
        }
        return $this->item($lottery, new LotteryTransformer());
    }

    // 获取项目抽奖数据
    public function datas($id)
    {
        $lottery = Lottery::find($id);
        if ( ! $lottery ) {
            return $this->response->errorNotFound('不存在项目');
        }
        $lotto = Lotto::find($lottery->lotto_id);
        $datas = $lotto->datas;
        return $this->item($datas, new DataTransformer());
    }

    // 获取项目抽奖奖项
    public function awards($id)
    {
        $lottery = Lottery::find($id);
        if ( ! $lottery ) {
            return $this->response->errorNotFound('不存在的项目');
        }
        $awards = $lottery->awards;
        return $this->item($awards, new AwardTransformer());
    }

}
