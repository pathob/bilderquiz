<?php

require_once('zorba_api_wrapper.php');

public class Base {

    private $_ms;
    private $_zorba;
    private $_dm;

    // constructor for entities not belonging to a database
    public function __construct() {
        $_ms = InMemoryStore::getInstance();
        $_zorba = Zorba::getInstance($_ms);
    }

    // constructor for entities belonging directly to a database
    public function __construct($database_name) {
        __construct();

        $_dm = $_zorba->getXmlDataManager();
        $_dm->loadDocument($database_name, file_get_contents($database_name));
    }

    public function __destruct() {
        $_zorba->shutdown();
        InMemoryStore::shutdown($_ms);
    }
}

?>
