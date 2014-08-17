<?php

namespace ChrisArmitage\DailyEvents\Tests;

use \Mockery as M;

class DailyTest extends \PHPUnit_Framework_Testcase
{
    protected function tearDown() {
        M::close();
    }
    
    public function testClassIsAvailable() {
        $storageEngine = M::mock('\ChrisArmitage\DailyEvents\StorageEngineInterface');
        
        $dailyEvents = new \ChrisArmitage\DailyEvents\DailyEvents($storageEngine);
        
        $this->assertNotNull($dailyEvents);
    }
    
    public function testCallsPersistOnStorageEngine() {
        $storageEngine = M::mock('\ChrisArmitage\DailyEvents\StorageEngineInterface');
        $storageEngine->shouldReceive('persist')
                ->once()
                ->with('event', 'key', 1);
        
        $dailyEvents = new \ChrisArmitage\DailyEvents\DailyEvents($storageEngine);
        
        $dailyEvents->record('event', 'key');
    }
    
    public function testCallsPersistOnStorageEngineWithOptionalValue() {
        $storageEngine = M::mock('\ChrisArmitage\DailyEvents\StorageEngineInterface');
        $storageEngine->shouldReceive('persist')
                ->once()
                ->with('event', 'key', 5);
        
        $dailyEvents = new \ChrisArmitage\DailyEvents\DailyEvents($storageEngine);
        
        $dailyEvents->record('event', 'key', 5);
    }
    
    public function testCallsRetrieveOnStorageEngine() {
        $storageEngine = M::mock('\ChrisArmitage\DailyEvents\StorageEngineInterface');
        $storageEngine->shouldReceive('retrieve')
                ->once()
                ->with('event', false)
                ->andReturn(array('event.name' => '2'));
        
        $dailyEvents = new \ChrisArmitage\DailyEvents\DailyEvents($storageEngine);
        
        $results = $dailyEvents->retrieve('event');
        
        $this->assertEquals(
                array('event.name' => '2'),
                $results);
    }
    
    public function testCallsRetrieveOnStorageEngineWithClearRecords() {
        $storageEngine = M::mock('\ChrisArmitage\DailyEvents\StorageEngineInterface');
        $storageEngine->shouldReceive('retrieve')
                ->once()
                ->with('event', true)
                ->andReturn(array('event.name' => '2'));
        
        $dailyEvents = new \ChrisArmitage\DailyEvents\DailyEvents($storageEngine);
        
        $results = $dailyEvents->retrieve('event', true);
        
        $this->assertEquals(
                array('event.name' => '2'),
                $results);
    }
}
