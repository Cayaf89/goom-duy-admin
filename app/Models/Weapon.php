<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Weapon
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $icon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|Attribute[] $attributes
 * @property Collection|Effect[] $effects
 * @property Collection|Statistic[] $statistics
 * @package App\Models
 * @property-read int|null $attributes_count
 * @property-read int|null $effects_count
 * @property-read int|null $statistics_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Weapon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Weapon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Weapon query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Weapon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Weapon whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Weapon whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Weapon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Weapon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Weapon whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Weapon extends Model
{
    protected $table = 'weapons';

    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    public function attributes(): BelongsToMany {
        return $this->belongsToMany(Attribute::class, 'weapons_attributes');
    }

    public function effects(): BelongsToMany {
        return $this->belongsToMany(Effect::class, 'weapons_effects');
    }

    public function statistics(): BelongsToMany {
        return $this->belongsToMany(Statistic::class, 'weapons_statistics');
    }
}
