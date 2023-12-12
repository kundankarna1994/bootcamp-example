<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = "questions";

    protected $casts = [
      'options' => "json"
    ];

    protected $fillable = [
      "title","slug","description","options","answer","status","weightage"
    ];
}
