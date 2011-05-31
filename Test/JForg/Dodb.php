<?php
/**
 * 
 * Factory class test.
 * 
 */
class Test_JForg_Dodb extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Dodb = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        // we use `new` instead of Solar::factory() so that we get back the
        // factory class itself, not an adapter generated by the factory
        $actual = new JForg_Dodb($this->_config);
        $expect = 'JForg_Dodb';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Disallow all calls to methods besides factory() and the existing support methods.
     * 
     */
    final public function test__call()
    {
        // we use `new` instead of Solar::factory() so that we get back the
        // factory class itself, not an adapter generated by the factory
        $obj = new JForg_Dodb($this->_config);
        try {
            $obj->noSuchMethod();
            $this->fail('__call() should not work');
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
    }
    
    /**
     * 
     * Test -- Factory method for returning adapter objects.
     * 
     */
    public function testFactory()
    {
        $actual = Solar::factory('JForg_Dodb', array('adapter' => 'JForg_Dodb_Adapter_Couchdb'));
        $expect = 'JForg_Dodb_Adapter';
        $this->assertInstance($actual, $expect);
    }
}