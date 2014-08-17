<?php

namespace ChrisArmitage\DailyEvents;

/**
 * Interface for StorageEngines
 * 
 * @category Utility
 * @package  DailyEvents
 * @author   Chris Armitage <dev@chrisarmitage.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 0.1
 * @link     https://github.com/ChrisArmitage/DailyEvents
 */
interface StorageEngineInterface
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
    public function persist($event, $key, $value);
    
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
    public function retrieve($event, $clearRecords);
}
