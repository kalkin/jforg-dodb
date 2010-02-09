<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_JForg_Dodb_Collection extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Dodb_Collection = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('JForg_Dodb_Collection');
        $expect = 'JForg_Dodb_Collection';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Appends a JForg_Dodb_Record to the Collection
     * 
     */
    public function testAppend()
    {
        $actual = Solar::factory('JForg_Dodb_Collection')->append(Solar::factory('JForg_Dodb_Record'));
        $actual->append(Solar::factory('JForg_Dodb_Record'));
        $actual->append(Solar::factory('JForg_Dodb_Record'));
        $actual->append(Solar::factory('JForg_Dodb_Record'));

        $this->assertEquals(count($actual),4);
    }
    
    
    /**
     * 
     * Test -- TODO: short description.
     * 
     */
    public function testDeleteAll()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Calls a user given function on each JForg_Dodb_Record
     * 
     */
    public function testDoForEach()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns all the keys of the Records in this collection
     * 
     */
    public function testGetKeys()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Is this Collection dirty?
     * 
     */
    public function testIsDirty()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Is the collection empty?
     * 
     */
    public function testIsEmpty()
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
     * Test -- Removes a JForg_Dodb_Record from the Collection by the documentId
     * 
     */
    public function testRemoveByDocId()
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
     * Test -- Saves all
     * 
     */
    public function testSave()
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
