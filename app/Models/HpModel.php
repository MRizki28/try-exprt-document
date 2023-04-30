<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HpModel extends Model
{
    use HasFactory;
    protected $table = 'tb_hp';
    protected $fillable = [
        'id' , 'uuid' , 'merek' , 'nama' , 'ram' , 'penyimpanan' , 'created_at' , 'updated_at'
    ];
}
