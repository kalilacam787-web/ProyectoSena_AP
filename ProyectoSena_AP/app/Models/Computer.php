<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'brand',
        'assigned_name',
        'assigned_document',
        'assigned_email',
    ];

    public function apprentices()
    {
        return $this->hasMany(Apprentice::class);
    }
}
