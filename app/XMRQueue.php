<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XMRQueue extends Model
{
    protected $table = 'xmrqueue';
    protected $fillable = ['amount','address','completed'];
}
