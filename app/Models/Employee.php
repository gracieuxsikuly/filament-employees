<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['first_name',
     'last_name', 'city_id',
     'department_id', 'country_id',
    'birth_date', 'hire_date', 'address', 'zipcode'];
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
}
