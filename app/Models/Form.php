<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class Form extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status', 'fields'];

    protected $casts = [
        'fields' => SchemalessAttributes::class,
    ];

    public function scopeWithFields(): Builder
    {
        return $this->fields->modelScope();
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
