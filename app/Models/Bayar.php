<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    use HasFactory;

    protected $table = 'bayars';
    protected $guarded =['created_at', 'updated_at'];
    protected $primaryKey = 'orders_id'; // Nama kolom primary key
    public $incrementing = false; // Jika primary key bukan tipe auto-increment
    protected $keyType = 'string'; // Jika primary key berupa string
}
