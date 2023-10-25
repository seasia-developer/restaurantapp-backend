<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function dbflush()
    {
        try {
            
            Redis::flushDB();

            return 'Redis Database Flushed';

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }
}
