<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ContactPerson;
class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email' , 'website_url' , 'logo'];


    public function scopeSearch($query)
    {
        // Search By Name And Email
        return $query->when(request()->search , function($q) {
            return $q->
            where('name' ,'like','%'.request()->search.'%')
                ->orWhere('email' ,'like','%'.request()->search.'%');
        });
    }


    public function contactPeople()
    {
        return $this->hasMany(ContactPerson::class);
    }
}
