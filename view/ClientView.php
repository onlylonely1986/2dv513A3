<?php


namespace view;

require_once("Messages.php");

class ClientView
    {
        private $clientId;
        private $clientName;

        public function __conctruct ()
        {
            
            
        }

        public function echoHTML($name, $id)
        {
            return "<p>This is the page of a specific client <b>" . $name. "</b> with the id: " . $id . " </p>";
        }

    }
