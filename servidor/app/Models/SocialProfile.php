<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialProfile extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'social_profiles';
    protected $fillable = [
        'social_id',
        'social_name',
        'avatar',
        'usuario_id'
    ];
}
