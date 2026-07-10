<?php



session_start();
session_destroy();

$nome = $_GET["nome"];


header("Location: ../remember/a/?nome=$nome");