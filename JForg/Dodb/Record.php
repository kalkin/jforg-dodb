<?php

/**
 * Contains an Documents and keys used to find him.
 * 
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @package   JForg_Dodb
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-02-09
 */
class JForg_Dodb_Record extends Solar_Base {


    /**
     * Contains the document
     * 
     * @var JForg_Dodb_Document  Defaults to null. 
     * @since 2010-02-09
     */
    protected $_document = null;

    /**
     * Populates the record with a document. This function can only be called
     * one time.
     * 
     * @param JForg_Dodb_Document $doc Add the doc to a record
     * 
     * @return JForg_Dodb_Record
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function populate(JForg_Dodb_Document $doc )
    {
        if ( $this->_document == null )
            $this->_document = $doc;

        return $this;
    }
    
    /**
     * If $record->document is called than the document is returned;
     * 
     * @param string $name The name of var to get
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function __get($name)
    {
        if ( $name === 'document' )
            return $this->_document;
    }

}
