<?php

namespace Aislandener\MixTelematicsLaravel\Models;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 *
 * @method static Builder|static query()
 * @method static static make(array $attributes = [])
 * @method static static create(array $attributes = [])
 * @method static static forceCreate(array $attributes)
 * @method static Builder|Group firstOrNew(array $attributes = [], array $values = [])
 * @method static Builder|Group firstOrFail($columns = ['*'])
 * @method static Builder|Group firstOrCreate(array $attributes, array $values = [])
 * @method static Builder|Group firstOr($columns = ['*'], Closure $callback = null)
 * @method static Builder|Group firstWhere($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder|Group updateOrCreate(array $attributes, array $values = [])
 * @method null|static first($columns = ['*'])
 * @method static static findOrFail($id, $columns = ['*'])
 * @method static static findOrNew($id, $columns = ['*'])
 * @method static null|static find($id, $columns = ['*'])
 *
 * @property-read int $id
 *
 * @property int GroupId
 * @property string Type
 * @property string Name
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 *
 * @property-read Group|null $parent
 * @property-read Collection|Group[]|null $subGroups
 */
class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'GroupId',
        'Type',
        'Name',
    ];

    /**
     * @return BelongsTo|null
     */
    public function parent(): ?BelongsTo
    {
        return $this->belongsTo($this,'group_id');
    }

    /**
     * @return HasMany|null
     */
    public function subGroups(): ?HasMany
    {
        return $this->hasMany($this, 'group_id');
    }

    /**
     * @return HasMany
     */
    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class,'SiteId', 'GroupId');
    }

    /**
     * @return HasMany
     */
    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class, 'SiteId','GroupId');
    }

}
