<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['project_name', 'description', 'start_date'];

    // Mối quan hệ 1-nhiều với Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
