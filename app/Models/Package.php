<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'title',
    'description',
    'price',
    'start_date',
    'end_date',
    'location',
    'featured',
    'cover_image',
    // Add other fields as needed
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // Add other relationships as needed
}
