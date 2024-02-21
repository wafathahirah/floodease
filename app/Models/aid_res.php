<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aid_res extends Model
{
    use HasFactory;
    protected $table = 'aid_res';
    protected $primaryKey = 'AidResID';
    protected $fillable = ['ComID','AidID','ResID','aid_resStatus','aid_resQuantity'];

    public function aid()
    {
        return $this->belongsTo(Aid::class, 'AidID', 'AidID');
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'ResID', 'ResID');
    }
    
    public function committee()
    {
        return $this->belongsTo(Committee::class, 'ComID', 'ComID');
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

public function staff()
{
    return $this->belongsTo(Staff::class, 'SID', 'SID');
}
}
