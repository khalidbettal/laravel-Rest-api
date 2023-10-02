<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Member extends Pivot
{
    protected $table = 'member';
    protected $fillable = [
        'project_id',
        'user_id',
    ];


}
