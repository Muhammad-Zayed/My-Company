<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name' , 'company_id' , 'email' , 'phone' , 'linkedin'];
    protected $table = 'contact-people';
    public function company()
    {
       return $this->belongsTo(Company::class);
    }

    public function scopeFilter($query)
    {
        return $query->when(request()->company_id,function($q) {
            return $q->where('company_id' ,request()->company_id);
        });
    }

    public function scopeSearch($q)
    {
        // Search By Name And Email
        return $q->when(request()->search , function($query) {
            return $query->where('first_name' ,'like','%'.request()->search.'%')
            ->orWhere('phone' ,'like','%'.request()->search.'%')
            ->orWhere('last_name' ,'like','%'.request()->search.'%')
            ->orWhere('email' ,'like','%'.request()->search.'%')
            ->orWhere(function ($q){
                return $q->whereRelation('company','name','like' ,'%'.request()->search.'%');
            })
            ->orWhere(function ($q){
                return $q->whereRelation('company','email','like' ,'%'.request()->search.'%');
            });
        });
    }
}
