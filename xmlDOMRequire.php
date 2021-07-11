<?php
        $xmlUser = new DOMDocument();
        $xmlUser->load("users.xml");
        $users = $xmlUser->getElementsbyTagName("user");
?>