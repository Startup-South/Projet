<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'BlogTitle',
        'BlogDescription',
        'BlogAuthor',
        'BlogVisibility',
        'BlogDate',
        'BlogImg'
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'BlogAuthor');
    }
    protected $casts = [
        'BlogVisibility' => 'boolean',
        'BlogDate' => 'datetime'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}

