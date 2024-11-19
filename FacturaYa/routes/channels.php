<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('metodo-pagos', function ($user) {
    return true;
});
