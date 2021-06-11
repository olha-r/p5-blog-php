<?php

function connected () {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connected']);
}

function user_connect() {
    if (!connected()) {
        header('Location: /index.php?action=signUp');
        exit();
    }
}

function blabla() {
    if (!empty($_POST['pseudo'])&& !empty($_POST['password'])) {

    }
    else {

    }
}