<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebsiteUser extends Model
{
    use SoftDeletes;

    public $table = 'website_users';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'website_id',
    ];

    public static $rules =
        [
            'user_id' => 'required|numeric',
            'website_id' => 'required|numeric',
        ];

    public static $messages = [
                                    'user_id.required' => "User ID is required.",
                                    'website_id.required' => "Website ID is required.",
                                    'user_id.numeric' => "User ID must be numeric",
                                    'website_id.numeric' => "Website ID must be numeric."
                             ];

}
