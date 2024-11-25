<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Statistic
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $short_name
 * @property string|null $unit
 * @property string|null $description
 * @property string|null $icon
 * @property float $base_value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Attribute[] $attributes
 * @property Collection|Class[] $classes
 * @property Collection|Effect[] $effects
 * @property Collection|Weapon[] $weapons
 *
 * @package App\Models
 */
class Statistic extends Model
{
    protected $table = 'statistics';

    protected $casts = [
        'base_value' => 'float',
    ];

    protected $fillable = [
        'name',
        'short_name',
        'unit',
        'description',
        'icon',
        'base_value',
    ];

    public function attributes(): HasMany {
        return $this->hasMany(Attribute::class, 'max_value_statistic_id');
    }

    public function classes(): BelongsToMany {
        return $this->belongsToMany(Classe::class, 'classes_statistics');
    }

    public function effects(): BelongsToMany {
        return $this->belongsToMany(Effect::class, 'effects_statistics');
    }
}
