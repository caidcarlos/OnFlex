<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoManual extends Model
{
    use HasFactory;

    protected $table = "pago_manual";

    protected $guarded = [];
}
