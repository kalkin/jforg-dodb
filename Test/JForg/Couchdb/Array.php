<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_JForg_Couchdb_Array extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Couchdb_Array = array(
    );

    protected $_instance;

    protected $_nullInstance;
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = $this->_instance;
        $expect = 'JForg_Couchdb_Array';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Implementation of Countable interface
     * 
     */
    public function testCount()
    {
        $actual = $this->_instance->count();
        $expect = 6;
        $this->assertSame($actual, $expect);

        
        $actual = count($this->_instance);
        $this->assertSame($actual, 6);

        $actual = count($this->_instance);
        $this->assertNotSame($actual, 7);

        $actual = count($this->_nullInstance);
        $this->assertSame($actual, 0);

    }
    
    /**
     * 
     * Test -- Return the current element
     * 
     */
    public function testCurrent()
    {
        $actual = $this->_instance->current();
        $this->assertSame($actual, "fff9bc300e5fcf291dcc80cb185ce83f");

        $this->_instance->next();
        $this->_instance->next();

        $actual = $this->_instance->current();
        $this->assertSame($actual, 1283032673);

        $actual = $this->_nullInstance->current();
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Return the key of the current element
     * 
     */
    public function testKey()
    {
        $actual = $this->_instance->key();
        $this->assertSame($actual, '_id');

        $this->_instance->next();
        $this->_instance->next();
        $actual = $this->_instance->key();
        $this->assertSame($actual, 'timestamp');

        $actual = $this->_nullInstance->key();
        $this->assertNull($actual);
    }
    
    /**
     * 
     * Test -- Move forward to next element
     * 
     */
    public function testNext()
    {
        $this->_instance->next();
        $actual = $this->_instance->current();
        $this->assertSame($actual, '1-8c8bbeab9c2c416b9e4b4d8bbb9bd137');

        $actual = $this->_nullInstance->next();
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Whether a offset exists
     * 
     */
    public function testOffsetExists()
    {
        $actual = isset($this->_instance['_id']);
        $this->assertTrue($actual);
        
        $actual = isset($this->_instance['666']);
        $this->assertFalse($actual);

        $this->_instance['666'] = null;
        $actual = isset($this->_instance['666']);
        $this->assertFalse($actual);

        $this->_instance['666'] = "";
        $actual = isset($this->_instance['666']);
        $this->assertTrue($actual);

        $actual = isset($this->_nullInstance['666']);
        $this->assertFalse($actual);


    }
    
    /**
     * 
     * Test -- Returns the value at specified offset.
     * 
     */
    public function testOffsetGet()
    {

        $actual = empty($this->_nullInstance["empty"]);
        $this->assertTrue($actual);
        
        // Test empty()
        $this->_nullInstance["empty"] = "";
        $actual = empty($this->_nullInstance["empty"]);
        $this->assertTrue($actual);

        $this->_nullInstance["empty"] = 0;
        $actual = empty($this->_nullInstance["empty"]);
        $this->assertTrue($actual);

        $this->_nullInstance["empty"] = "0";
        $actual = empty($this->_nullInstance["empty"]);
        $this->assertTrue($actual);

        $this->_nullInstance["empty"] = null;
        $actual = empty($this->_nullInstance["empty"]);
        $this->assertTrue($actual);

        $this->_nullInstance["empty"] = false;
        $actual = empty($this->_nullInstance["empty"]);
        $this->assertTrue($actual);

        $this->_nullInstance["empty"] = array();
        $actual = empty($this->_nullInstance["empty"]);
        $this->assertTrue($actual);
    }
    
    /**
     * 
     * Test -- Assigns a value to the specified offset.
     * 
     */
    public function testOffsetSet()
    {
        $this->skip("Already tested in offsetGet");
    }
    
    /**
     * 
     * Test -- Unsets an offset.
     * 
     */
    public function testOffsetUnset()
    {
        unset($this->_instance['_id']);
        $actual = isset($this->_instance['_id']);
        $this->assertFalse($actual);

        $actual = isset($this->_instance['foo']);
        $this->assertFalse($actual);
    }
    
    
    /**
     * 
     * Test -- Rewind the Iterator to the first element
     * 
     */
    public function testRewind()
    {
        $actual = $this->_instance->current();
        $this->assertSame($actual, "fff9bc300e5fcf291dcc80cb185ce83f");

        $this->_instance->next();
        $this->_instance->next();
        $this->_instance->rewind();
        $this->assertSame($actual, "fff9bc300e5fcf291dcc80cb185ce83f");

        $actual = $this->_nullInstance->rewind();
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Checks if current position is valid
     * 
     */
    public function testValid()
    {
        $actual = $this->_instance->valid();
        $this->assertNotFalse($actual);

        $this->_instance->next();
        $this->_instance->next();
        $this->_instance->next();
        $this->_instance->next();
        $this->_instance->next();
        $this->_instance->next();
        $this->_instance->next();
        $this->_instance->next();

        $actual = $this->_instance->valid();
        $this->assertFalse($actual);

        $actual = $this->_nullInstance->valid();
        $this->assertFalse($actual);

    }

    public function preTest() 
    {
        $this->_instance = Solar::factory('JForg_Couchdb_Array', 
                array('data' => array(
                    "_id"=> "fff9bc300e5fcf291dcc80cb185ce83f",
                    "_rev"=> "1-8c8bbeab9c2c416b9e4b4d8bbb9bd137",
                    "timestamp"=> 1283032673,
                    "type"=> "Frontend_Dodb_Document_Accounting",
                    "pseudo"=> "sexmonster",
                    "ammount"=> -1,
                    )));
        $this->_nullInstance = Solar::factory('JForg_Couchdb_Array');
    }
}
