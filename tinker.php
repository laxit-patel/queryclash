<?php

use Illuminate\Support\Facades\DB;

dd(DB::connection('honeypot')->table('states')->get()); 