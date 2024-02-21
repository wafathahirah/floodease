<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $table = 'resident';
    protected $primaryKey = 'ResID';
    protected $fillable = ['ResID','ResDependencies','HouseCondition','ResName','ResCity','ResStreet','ResPastAid','user_id'];

    public function aid()
    {
        return $this->belongsToMany(Aid::class, 'aid_res', 'AidID', 'ResID');

    }

    public function JKK()
    {
        return $this->belongsToMany(JKK::class, 'jkk_res', 'JKKID', 'ResID');
    }
    public function committee()
{
    return $this->hasOne(Committee::class, 'SID');
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
