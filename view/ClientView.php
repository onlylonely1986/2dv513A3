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

        public function echoHTML()
        {
            // Print_r ($_SESSION['pickedClient']);
            $this->clientId = $_SESSION['pickedClientId'];
            $this->clientName = $_SESSION['pickedClientName'];
            return "<p>This is the page of a specific client <b>" . $this->clientName. "</b> with the id: " . $this->clientId . " </p>";
        }

    }
