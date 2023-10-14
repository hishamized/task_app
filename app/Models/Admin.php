<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'roles',
    ];

    /**
     * Define the relationship between Admin and User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'admin_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'admin_id');
    }
    public function task_assignments()
    {
        return $this->hasMany(TaskAssignment::class, 'admin_id');
    }
    public function project_histories()
    {
        return $this->hasMany(ProjectHistory::class, 'admin_id');
    }
    public function task_histories()
    {
        return $this->hasMany(TaskHistory::class, 'admin_id');
    }
}
