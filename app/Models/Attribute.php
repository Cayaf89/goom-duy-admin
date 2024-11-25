<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Attribute
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $short_name
 * @property string|null $description
 * @property string|null $icon
 * @property float $min_value
 * @property int $max_value_statistic_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Statistic $statistic
 * @property Collection|Class[] $classes
 * @property Collection|Effect[] $effects
 * @property Collection|Weapon[] $weapons
 *
 * @package App\Models
 */
class Attribute extends Model
{
    protected $table = 'attributes';

    protected $casts = [
        'min_value'              => 'float',
        'max_value_statistic_id' => 'int',
    ];

    protected $fillable = [
        'name',
        'short_name',
        'description',
        'icon',
        'min_value',
        'max_value_statistic_id',
    ];

    public function statistic(): BelongsTo {
        return $this->belongsTo(Statistic::class, 'max_value_statistic_id');
    }

    public function classes(): BelongsToMany {
        return $this->belongsToMany(Classe::class, 'classes_attributes');
    }

    public function effects(): BelongsToMany {
        return $this->belongsToMany(Effect::class, 'effects_attributes');
    }

    public function weapons(): BelongsToMany {
        return $this->belongsToMany(Weapon::class, 'weapons_attributes');
    }
}
