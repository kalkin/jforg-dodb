<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_JForg_Dodb_Document_Collection extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Dodb_Document_Collection = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('JForg_Dodb_Document_Collection');
        $expect = 'JForg_Dodb_Document_Collection';
        $this->assertInstance($actual, $expect);
    }
}
