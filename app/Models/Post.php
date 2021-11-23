<?php

namespace App\Models;

use App\Models\PartnerType\PartnerType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public $table = 'posts';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'post_title',
        'post_description',
        'website_id',
    ];

    public static $rules =
        [
            'post_title' => 'required',
            'post_description' => 'required',
            'website_id' => 'required|numeric',
        ];

    public static $messages = [
                                    'post_title.required' => "Post title is required.",
                                    'post_description.required' => "Post description is required.",
                                    'website_id.required' => "Website ID is required.",
                                    'website_id.numeric' => "Website ID must be numeric."
                             ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
