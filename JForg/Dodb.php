<?php
/**
 * Factory to return an document oriented database adapter instance
 * 
 * @package   JForg_Dodb
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-01-28
 */
class JForg_Dodb extends Solar_Factory
{

    /**
     * Default configuration values.
     *
     * @config string adapter The adapter class to use
     * 
     * @var mixed  Defaults to array(            ). 
     * @since 2010-01-28
     */
    protected $_JForg_Dodb = array(
        'adapter' = null;
            );

}
