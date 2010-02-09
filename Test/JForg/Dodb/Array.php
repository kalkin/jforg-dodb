<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_JForg_Dodb_Array extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Dodb_Array = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('JForg_Dodb_Array');
        $expect = 'JForg_Dodb_Array';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Return the current element
     * 
     */
    public function testCurrent()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Return the key of the current element
     * 
     */
    public function testKey()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Move forward to next element
     * 
     */
    public function testNext()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Populates JForg_Dodb_Array with data
     * 
     */
    public function testPopulate()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Rewind the Iterator to the first element
     * 
     */
    public function testRewind()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Checks if current position is valid
     * 
     */
    public function testValid()
    {
        $this->todo('stub');
    }
}
