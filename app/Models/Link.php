<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = ['id',
    'features->bg_image',
    'features->bg_color',
    'features->link_color',
    'features->frame_color',
    'features->switch_frame_color',

    'features->selected',

    'links'
    ];
    protected $casts = [
        'features' => 'json',
    ];
}
