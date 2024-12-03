<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Awcodes\Curator\Models\Media;
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
 * @property Statistic $statistic
 * @property Collection|Class[] $classes
 * @property Collection|Effect[] $effects
 * @property Collection|Weapon[] $weapons
 * @package App\Models
 * @property-read int|null $classes_count
 * @property-read int|null $effects_count
 * @property-read int|null $weapons_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereMaxValueStatisticId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereMinValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    protected $table = 'attributes';

    protected $fillable = [
        'name',
        'short_name',
        'description',
        'icon_id',
        'min_value',
        'max_value_statistic_id',
    ];

    protected $casts = [
        'icon_id'                   => 'int',
        'min_value'              => 'float',
        'max_value_statistic_id' => 'int',
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

    public function icon(): BelongsTo {
        return $this->belongsTo(Media::class, 'icon_id', 'id');
    }
}
