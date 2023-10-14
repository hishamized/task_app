<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'username',
        'phone_country_code',
        'phone_number',
        'is_admin',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Find a user by username or email.
     *
     * @param string $userIdentifier
     * @return \App\Models\User|null
     */
    public static function findByUsernameOrEmail($userIdentifier)
    {
        return static::where('email', $userIdentifier)
            ->orWhere('username', $userIdentifier)
            ->first();
    }


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        // Check if the 'is_admin' attribute is 1
        if ($this->is_admin == 1) {
            // Check if there is a corresponding row in the 'admins' table
            return !!$this->admin;
        }

        return false;
    }


    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'user_id');
    }

    public function project_mates()
    {
        return $this->hasMany(ProjectMate::class, 'user_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }
    public function task_assignments()
    {
        return $this->hasMany(TaskAssignment::class, 'user_id');
    }
    public function leaves()
    {
        return $this->hasMany(Leave::class, 'user_id', 'id');
    }
    public function project_history()
    {
        return $this->hasMany(ProjectHistory::class, 'user_id');
    }
    public function task_history()
    {
        return $this->hasMany(TaskHistory::class, 'user_id');
    }
}
