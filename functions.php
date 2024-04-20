<?php

    function getContacts($fileName) {

        if (!file_exists($fileName)) return [];

        $json = file_get_contents($fileName);

        return json_decode($json, true);
    }

    function addContact($fileName, $name, $phone) {

        $contacts = getContacts($fileName);

        $contacts[] = [

            'name' => $name,

            'phone' => $phone,
        ];

        file_put_contents($fileName, json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    function deleteContact($fileName, $index) {

        $contacts = getContacts($fileName);

        array_splice($contacts, $index, 1);

        file_put_contents($fileName, json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }