<?php

/** Se a requisição foi feita via ajax */
define('IS_AJAX', !IS_TERMINAL && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') == 'XMLHTTPREQUEST');