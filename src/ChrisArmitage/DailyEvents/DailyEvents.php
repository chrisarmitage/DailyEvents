<?php

namespace ChrisArmitage\DailyEvents;

use ChrisArmitage\DailyEvents\StorageEngineInterface as StorageEngineInterface;

/**
 * Used to record daily events
 * 
 * Designed for recoeding events throughout the day, then emailing them out overnight
 * 
 * @category Utility
 * @package  DailyEvents
 * @author   Chris Armitage <dev@chrisarmitage.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 0.1
 * @link     https://github.com/ChrisArmitage/DailyEvents
 */
class DailyEvents
{
    protected $storageEngine;
    
    /**
     * Constructor
     * 
     * @param \ChrisArmitage\DailyEvents\StorageEngineInterface $storageEngine Used to stire the events
     */
    public function __construct(StorageEngineInterface $storageEngine) {
        $this->storageEngine = $storageEngine;
    }
    
    /**
     * Records an event and key to the StorageEngine
     * 
     * Example. $event = 'user-login-failed', $key = 'user123'
     * 
     * @param type $event The name of the event being recorded
     * @param type $key   The value key attached to the event
     * @param type $value The number of events to record
     * 
     * @return null
     * 
     * @todo Check for success and return
     */
    public function record($event, $key, $value = 1) {
        $this->storageEngine->persist($event, $key, $value);
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
    public function retrieve($event, $clearRecords = false) {
        return $this->storageEngine->retrieve($event, $clearRecords);
    }
}
