<?php

namespace ChrisArmitage\DailyEvents;

interface StorageEngineInterface
{
    public function persist($event, $key, $value);
    
    public function retrieve($event, $clearRecords);
}
