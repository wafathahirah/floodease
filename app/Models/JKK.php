<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JKK extends Model
{
    use HasFactory;
    protected $table = 'jkk';
    protected $primaryKey = 'JKKID';
    protected $fillable = ['JKKID','JKKName', 'JKKPhoneNum', 'JKKEmail', 'VillageName','user_id'];
    public $timestamps = false;

   
    public function resident()
    {
        return $this->belongsToMany(Resident::class, 'jkk_res', 'JKKID', 'ResID');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
