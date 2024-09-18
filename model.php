// Model //

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_image',
        'benefits_icon',
        'benefits_name',
        'benefits_description',
        'focused_image',
        'focused_text',
        'focused_link',
        'technology_image',
        'technology_text',
        'wcu_short_des',
        'wcu_icon',
        'wcu_title',
        'wcu_des',
        'faq_question',
        'faq_answer',
        'service_page_id',
    ];

    protected $casts = [
        'benefits_icon' => 'array',
        'benefits_name' => 'array',
        'benefits_description' => 'array',
        'focused_image' => 'array',
        'focused_text' => 'array',
        'focused_link' => 'array',
        'technology_image' => 'array',
        'technology_text' => 'array',
        'wcu_short_des' => 'array',
        'wcu_icon' => 'array',
        'wcu_title' => 'array',
        'wcu_des' => 'array',
        'faq_question' => 'array',
        'faq_answer' => 'array',
    ];
}
