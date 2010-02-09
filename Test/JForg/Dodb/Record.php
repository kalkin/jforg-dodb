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

        $actual = Solar::factory('JForg_Dodb_Record')->populate('asd', Solar::factory('JForg_Dodb_Document'))->document;
        $this->assertInstance($actual, 'JForg_Dodb_Document');
    }
    
    /**
     * 
     * Test -- Populates the record with a document.
     * 
     */
    public function testPopulate()
    {
        $actual = Solar::factory('JForg_Dodb_Record')
            ->populate('foo', Solar::factory('JForg_Dodb_Document'))
            ->document
            ->setHimbeere('asd')
            ->getHimbeere();
        Solar::dump($actual);;
        
        $this->assertEquals($actual, 'asd');

    }
    
    /**
     * 
     * Test -- TODO: short description.
     * 
     */
    public function testGetKey()
    {
        $actual = Solar::factory('JForg_Dodb_Record')
            ->populate('foo', Solar::factory('JForg_Dodb_Document'))
            ->getKey();
        $this->assertEquals($actual, 'foo');
    }

    protected function _postConfig()
    {
        Solar_Registry::set('dodb', 'JForg_Dodb');
    }
}
