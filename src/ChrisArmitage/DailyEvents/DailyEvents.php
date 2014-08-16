<?php

namespace ChrisArmitage\DailyEvents;

use ChrisArmitage\DailyEvents\StorageEngineInterface as StorageEngineInterface;

class DailyEvents
{
    protected $storageEngine;
    
    public function __construct(StorageEngineInterface $storageEngine) {
        $this->storageEngine = $storageEngine;
    }
    
    public function record($event, $key, $value = 1) {
        $this->storageEngine->persist($event, $key, $value);
    }
    
    public function retrieve($event, $clearRecords = false) {
        return $this->storageEngine->retrieve($event, $clearRecords);
    }

}