<?php

require_once 'src/SessionManager.php';
SessionManager::logout();

header('Location: index.php');
exit();
