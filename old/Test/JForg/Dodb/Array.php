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
     * Test -- Populates JForg_Dodb_Array with data
     * 
     */
    public function testPopulate()
    {
        $actual = Solar::factory('JForg_Dodb_Array');
        $actual->populate(array ( 'foo', 'bar', 'asd', 'bar' => 'foo' ));

        $i = 0;
        foreach ( $actual as $val )
        {
            Solar::dump($val);
            $i++;
        }

        $this->assertEquals($i, 4);

    }

    /**
     * TODO: short description.
     * 
     * @return TODO
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function testCount()
    {
        $actual = count(Solar::factory('JForg_Dodb_Array')
            ->populate(array ( 'foo', 'bar', 'asd', 'bar' => 'foo' )));
        Solar::dump($actual);
        $this->assertEquals($actual,4);
    }
}
