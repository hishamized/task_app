<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'admin_id',
        'task_title',
        'task_description',
        'task_objectives',
        'creation_date',
        'deadline',
        'status',
        'priority',
        'progress',
    ];


    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }


    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function task_assignments()
    {
        return $this->hasMany(TaskAssignment::class, 'task_id');
    }
}
