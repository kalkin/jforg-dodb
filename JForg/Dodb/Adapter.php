<?php
/**
 * Abstract base class for specific DODB adapters.
 * 
 * When writing an adapter, you need to override these abstract methods:
 * 
 * {{code: php
 *  abstract public function find($id);
 *  abstract public function save($id);
 *  abstract public function query(array $array);
 * }}
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-01-26
 */
abstract class JForg_Dodb_Document_Adapter extends Solar_Base 
{
    abstract public function find($id);

    abstract public function save($id);

    abstract public function query(array $array);
}
