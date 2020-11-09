<?php
include_once realpath(__DIR__ . '/../classes/Database.php');
include_once realpath(__DIR__ . '/../classes/Clients.php');

$clients = new Clients;

$clients->pingClients();
