<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;
    protected $table = 'committee';
    protected $primaryKey='ComID';
    protected $fillable = ['ComID','SID','PosID','ComTask','ComLeader','ComDate'];

    public $timestamps = false;

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'SID', 'SID');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'PosID', 'PosID');
    }
    public function resident()
    {
        return $this->belongsTo(Resident::class, 'SID');
    }
    
    public function aid()
    {
        return $this->hasMany(Aid::class, 'ComID');
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
