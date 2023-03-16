<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'completed'];

    use HasFactory;

    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'completed' => $this->completed
        ];
    }
}
