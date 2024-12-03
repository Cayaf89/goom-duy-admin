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
 * Class Effect
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $short_name
 * @property string|null $description
 * @property string|null $icon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|Class[] $classes
 * @property Collection|Attribute[] $attributes
 * @property Collection|Statistic[] $statistics
 * @property Collection|Weapon[] $weapons
 * @package App\Models
 * @property-read int|null $attributes_count
 * @property-read int|null $classes_count
 * @property-read int|null $statistics_count
 * @property-read int|null $weapons_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Effect extends Model
{
    protected $table = 'effects';

    protected $fillable = [
        'name',
        'short_name',
        'description',
        'icon',
    ];

    public function classes(): BelongsToMany {
        return $this->belongsToMany(Classe::class, 'classes_effects');
    }

    public function attributes(): BelongsToMany {
        return $this->belongsToMany(Attribute::class, 'effects_attributes');
    }

    public function statistics(): BelongsToMany {
        return $this->belongsToMany(Statistic::class, 'effects_statistics');
    }

    public function weapons(): BelongsToMany {
        return $this->belongsToMany(Weapon::class, 'weapons_effects');
    }
}
