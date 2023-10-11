<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssignment extends Model
{
    use HasFactory;
    protected $table = 'task_assignments';

    protected $fillable = [
        'task_id',
        'project_id',
        'user_id',
        'admin_id',
        'status',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    public function task_assignment_updates()
    {
        return $this->hasMany(TaskAssignmentUpdate::class, 'task_assignment_id');
    }
}
