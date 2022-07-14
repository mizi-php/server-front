<?php

use Mizi\Env;

Env::default('SESSION_TIME', 672);

Env::default('COOKIE_TIME', Env::get('SESSION_TIME'));