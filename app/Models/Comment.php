<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  use HasFactory;
  public function owner() {
    return $this->belongsTo(User::class, 'owner_id', 'id');
  }

  public function attachements() {
    return $this->hasMany(Attachement::class, 'comment_id', 'id');
  }
}
