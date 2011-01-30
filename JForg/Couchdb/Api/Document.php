<?php
/**
 * This is the couchdb low level communication class. It just barely wraps the
 * http api document methods
 * 
 * @package   JForg_Couchdb_Api
 * @author    Bahtiar `kalkin-` Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2011 Bahtiar Gadimov
 * @since     2011-01-30
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 * Copyright (c) 2010, Bahtiar Gadimov All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 
 *     * Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright notice,
 *       this list of conditions and the following disclaimer in the documentation
 *       and/or other materials provided with the distribution.
 *     * Neither the name of the cologne.idle nor the names of its contributors
 *       may be used to endorse or promote products derived from this software
 *       without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
class JForg_Couchdb_Api_Document extends JForg_Couchdb_Api{


    /**
     * Deletes a document by id and it's revision
     * 
     * @param mixed $id Document id
     * @param mixed $rev Revision the document is based on
     * @access public
     * @return string
     */
    public function delete($id, $rev)
    {
        return null;
    }

    /**
     * Returns a document as array by id   
     *
     * @access public
     * @param string $id Document id
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     * @return string
     */
    public function fetch($id){ return null;}


    /**
     * Saves a document as a json string to the database
     * 
     * @access public
     * @param string $doc An json string representing a document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     * @return string
     */
    public function save($doc)
    {
        return false;
    }

}
