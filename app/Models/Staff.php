<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'staff';
    protected $primaryKey='SID';
    protected $fillable = ['SID','SName','SPhoneNum','SAddress','SEmail','SRole','SPwd','user_id'];

public function position()
    {
        return $this->belongsToMany(Position::class, 'committee', 'PosID', 'SID');
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
