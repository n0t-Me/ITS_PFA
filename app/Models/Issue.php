<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
  use HasFactory;

  public function owner() {
    return $this->belongsTo(User::class, 'owner_id', 'id');
  }

  public function attachements() {
    return $this->hasMany(Attachement::class, 'issue_id', 'id');
  }

  public function comments() {
    return $this->hasMany(Comment::class, 'issue_id', 'id');
  }

  public function assignee() {
    return $this->belongsTo(User::class, 'assignee_id', 'id');
  }

  public function team() {
    return $this->belongsTo(Team::class, 'team_id', 'id');
  }
}
