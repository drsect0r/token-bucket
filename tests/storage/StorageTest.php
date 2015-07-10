<?php

namespace bandwidthThrottle\tokenBucket\storage;

/**
 * Tests for Storage implementations.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @link bitcoin:1335STSwu9hST4vcMRppEPgENMHD2r1REK Donations
 * @license WTFPL
 * @see Storage
 */
class StorageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Provides uninitialized Storage implementations.
     *
     * @return Storage[][] Storage implementations.
     */
    public function provideImplementations()
    {
        return [
            [new SingleProcessStorage()]
        ];
    }
    
    /**
     * Tests setMicrotime() and getMicrotime().
     *
     * @param Storage $storage The SUT.
     * @test
     * @dataProvider provideImplementations
     */
    public function testSetAndGetMicrotime(Storage $storage)
    {
        $storage->setMicrotime(1.1);
        $this->assertEquals(1.1, $storage->getMicrotime());
        $this->assertEquals(1.1, $storage->getMicrotime());
        
        $storage->setMicrotime(1.2);
        $this->assertEquals(1.2, $storage->getMicrotime());
    }
    
    /**
     * Tests isBootstrapped().
     *
     * @param Storage $storage The SUT.
     * @test
     * @dataProvider provideImplementations
     */
    public function testIsBootstrapped(Storage $storage)
    {
        $this->assertFalse($storage->isBootstrapped());
        $storage->bootstrap(123);
        $this->assertTrue($storage->isBootstrapped());
        $this->assertEquals(123, $storage->getMicrotime());
    }
}
