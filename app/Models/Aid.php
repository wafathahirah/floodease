<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aid extends Model
{
    use HasFactory;
    protected $table = 'aid';
    protected $primaryKey = 'AidID';
    protected $fillable = ['AidType','TotalAid','ItemName'];

    public function resident()
    {
        return $this->belongsToMany(Resident::class, 'aid_res', 'AidID', 'ResID');
    }

    public function committee()
    {
        return $this->belongsTo(Committee::class, 'ComID', 'ComID');
    }

    public function calculatePackageA()
    {
        return $this->where('AidType','A')->sum('amount');
    }
    public function calculatePackageB()
    {
        return $this->where('AidType','B')->sum('amount');
    }
    public function calculatePackageC()
    {
        return $this->where('AidType','C')->sum('amount');
    }
}
