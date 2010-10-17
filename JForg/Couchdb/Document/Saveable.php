<?php
interface JForg_Couchdb_Document_Saveable 
{
    /**
     * Returns an array with document data. The structure is prepared for
     * inserting a document in to couchdb
     * 
     * @return array
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function toArray();
}
