<?php
        $xml = new DOMDocument();
        $xml->load("users.xml");
        $users = $xml->getElementsbyTagName("user");
?>