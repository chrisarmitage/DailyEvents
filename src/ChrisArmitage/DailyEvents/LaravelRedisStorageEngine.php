<?php

namespace ChrisArmitage\DailyEvents;

use ChrisArmitage\DailyEvents\StorageEngineInterface as StorageEngineInterface;
use Illuminate\Support\Facades\Redis as Redis;

/**
 * Storage Engine for use by DailyEvents.
 * 
 * Requires Laravel.
 * 
 * @category Category
 * @package  DailyEvents
 * @author   Chris Armitage <dev@chrisarmitage.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 0.1
 * @link     https://github.com/ChrisArmitage/DailyEvents
 */
class LaravelRedisStorageEngine implements \ChrisArmitage\DailyEvents\StorageEngineInterface
{
    /**
     * Persists an event and key to the StorageEngine
     * 
     * @param type $event The name of the event being recorded
     * @param type $key   The value key attached to the event
     * @param type $value The number of events to record
     * 
     * @return null
     * 
     * @todo Check for success and return
     */
    public function persist($event, $key, $value) {
        $redis = Redis::connection();
        $redis->incrby("{$event}:{$key}", $value);
    }
    
    /**
     * Retrieves the event specified. May accept wildcards depending StorageEngine.
     * 
     * @param type $event        The name of the event being retrieved
     * @param type $clearRecords After retrieval, should the records be deleted / reset
     * 
     * @return type array
     * 
     * @todo Decide how to return the data
     */
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
