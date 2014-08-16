<?php

namespace ChrisArmitage\DailyEvents;

use ChrisArmitage\DailyEvents\StorageEngineInterface as StorageEngineInterface;
use Illuminate\Support\Facades\Redis as Redis;

class LaravelRedisStorageEngine implements \ChrisArmitage\DailyEvents\StorageEngineInterface
{
    public function persist($event, $key, $value) {
        $redis = Redis::connection();
        $redis->incrby("{$event}:{$key}", $value);
    }
    
    public function retrieve($event, $clearRecords) {
        $redis = Redis::connection();
        $results = array();
        
        $eventsAvailable = $redis->keys($event);
        
        foreach ($eventsAvailable as $eventName) {
            $tally = $redis->get($eventName);
            if ($clearRecords) {
                $redis->del($eventName);
            }
            $results[$eventName] = $tally;
        }
        
        return $results;
    }
}