<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_JForg_Dodb_Record extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Dodb_Record = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('JForg_Dodb_Record');
        $expect = 'JForg_Dodb_Record';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- If $record->document is called than the document is returned;
     * 
     */
    public function test__get()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Populates the record with a document.
     * 
     */
    public function testPopulate()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- TODO: short description.
     * 
     */
    public function testGetKey()
    {
        $this->todo('stub');
    }
}
