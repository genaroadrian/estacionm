<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariablesMetereologicas extends Model
{
    use HasFactory;

    protected $table = "variables_metereologicas";

    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'direccion',
        'humedad',
        'lluvia',
        'luz',
        'temperatura',
        'velocidad',
        'presion'
    ];
}
