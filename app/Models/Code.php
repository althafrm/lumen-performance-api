<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    public $timestamps = false;

    public CONST TABLE_NAME = 'code';

    protected $table = self::TABLE_NAME;

    protected $fillable = ['unique_code'];
}
