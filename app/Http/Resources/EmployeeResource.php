<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'first_name'=> $this->first_name,
            'last_name'=> $this->last_name,
            'country'=> $this->country->name,
            'stateId'=> $this->state_id,
            'cityId'=> $this->city_id,
            'departmentId'=> $this->department_id,
            'birth_date'=> $this->birth_date,
            'hire_date'=> $this->hire_date,
            'address'=> $this->address,
            'zipcode'=> $this->zipcode,
        ];

    //     protected $fillable = ['first_name',
    //     'last_name', 'city_id','state_id',
    //     'department_id', 'country_id',
    //    'birth_date', 'hire_date', 'address', 'zipcode','avatar'];
    }
}
