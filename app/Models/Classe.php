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
 * Class Classe
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $icon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Attribute[] $attributes
 * @property Collection|Effect[] $effects
 * @property Collection|Statistic[] $statistics
 *
 * @package App\Models
 */
class Classe extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    public function attributes(): BelongsToMany {
        return $this->belongsToMany(Attribute::class, 'classes_attributes');
    }

    public function effects(): BelongsToMany {
        return $this->belongsToMany(Effect::class, 'classes_effects');
    }

    public function statistics(): BelongsToMany {
        return $this->belongsToMany(Statistic::class, 'classes_statistics');
    }
}
