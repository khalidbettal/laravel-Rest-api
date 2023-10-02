<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;

    protected  $fillable = [
        'title',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, Member::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('member', function (Builder $builder) {
            $builder->whereRelatin('members','user_id', Auth::id());
        });
    }
}
