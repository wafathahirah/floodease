<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'position';
    protected $primaryKey = 'PosID';
    protected $fillable = ['PosName','PosDesc'];
    public $timestamps = false;

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'committee', 'PosID', 'SID');
    }
}
