<?php

namespace App\Models;

use App\Models\Company\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use SoftDeletes;

    public $table = 'websites';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'website_url',
        'website_description',
    ];

    public static $rules =
        [
            'name' => 'required',
            'website_url' => 'required|unique:websites,website_url',
        ];

    public static $messages = [
                                    'name.required' => "Website name is required.",
                                    'website_url.required' => "Website url is required.",
                                    'website_url.unique' => "Website URL must be unique."
                             ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'website_users',);
    }
}
