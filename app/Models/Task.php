<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id','assigned_to','title','description','due_date','status','remarks'
    ];

    public function project()  {
         return $this->belongsTo(Project::class);
         }
    public function employee() { 
        return $this->belongsTo(User::class, 'assigned_to');
     }
    
}