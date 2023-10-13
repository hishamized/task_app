<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHistory extends Model
{
    use HasFactory;

    protected $table = 'projects_history';

    protected $fillable = [
        'project_id',
        'user_id',
        'admin_id',
        'action',
        'action_date',
        'user_assignment_date',
    ];

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
}
