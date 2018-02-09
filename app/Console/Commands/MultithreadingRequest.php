<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;

class MultithreadingRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:multithreading-request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '多线程请求';

    private $totalPageCount;
    private $counter = 1;
    private $concurrency = 7;
    private $users = ['enzohobmg', 'apisces', 'jamweak', 'realpg', 'Tink', 'bayker', 'carvofeng'];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->totalPageCount = count($this->users);
        $client = new Client();
        $client->setDefaultOption('verify', false);
        // $client = new Client(['verify' => '/full/path/to/cert.pem']);

        $requests = function ($total) use ($client) {
            foreach ($this->users as $key => $user) {
                $uri = 'https://www.v2ex.com/api/members/show.json?username=' . $user;
                yield function() use ($client, $uri) {
                    return $client->getAsync($uri);
                };
            }
        };

        $pool = new Pool($client, $requests($this->totalPageCount), [
            'concurrency' => $this->concurrency,
            'fulfilled' => function ($response, $index){
                $res = json_decode($response->getBody()->getContents());
                $this->info("请求第 $index 个请求，用户 " . $this->users[$index] . " 的 v2ex ID 为：" .$res->id);
                $this->countedAndCheckEnded();
            },
            'rejected' => function ($reason, $index){
                $this->error("rejected" );
                $this->error("rejected reason: " . $reason );
                $this->countedAndCheckEnded();
            },
        ]);

        // 开始发送请求
        $promise = $pool->promise();
        $promise->wait();
    }

    public function countedAndCheckEnded()
    {
        if ( $this->counter < $this->totalPageCount )
        {
            $this->counter++;
            return;
        }
        $this->info('request finished');
    }
}
