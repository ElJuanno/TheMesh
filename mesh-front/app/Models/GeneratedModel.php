<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeneratedModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prompt',
        'object_type',
        'filename',
        'file_path',
        'download_url',
        'units',
        'bbox',
        'max_dimension_mm',
        'volume_mm3',
        'triangle_count',
        'watertight',
        'winding_consistent',
        'manifold',
        'print_type',
        'material',
        'hollowed',
        'wall_thickness_mm',
        'orientation',
        'api_response',
        'status',
        'error_message',
    ];

    protected $casts = [
        'bbox' => 'array',
        'api_response' => 'array',
        'watertight' => 'boolean',
        'winding_consistent' => 'boolean',
        'manifold' => 'boolean',
        'hollowed' => 'boolean',
        'max_dimension_mm' => 'decimal:2',
        'volume_mm3' => 'decimal:2',
        'wall_thickness_mm' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
