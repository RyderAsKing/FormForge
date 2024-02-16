<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class Response extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'form_id', 'email', 'fields'];

    protected $casts = [
        'fields' => SchemalessAttributes::class,
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function scopeWithFields(): Builder
    {
        return $this->fields->modelScope();
    }
}
