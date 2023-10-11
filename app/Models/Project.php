<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'title',
        'description',
        'start_date',
        'expected_end_date',
        'status',
    ];

    // Define the User relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the Admin relationship
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function project_mates(){
        return $this->hasMany(ProjectMate::class, 'project_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }
    public function task_assignments()
    {
        return $this->hasMany(TaskAssignment::class, 'project_id');
    }
}
