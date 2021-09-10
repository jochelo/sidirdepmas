<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolPermiso extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rol_permisos';
    protected $fillable = [
      'rol_id',
      'permiso_id'
    ];

    protected $appends = [
      'url'
    ];

    public function getUrlAttribute()
    {
        $permiso = Permiso::find($this->permiso_id);
        return $permiso['url'];
    }
}
