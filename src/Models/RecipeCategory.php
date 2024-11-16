<?php

namespace VentureDrake\LaravelCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use VentureDrake\LaravelCrm\Traits\BelongsToTeams;
use VentureDrake\LaravelCrm\Traits\HasCrmFields;

class RecipeCategory extends Model
{
    use SoftDeletes;
    use BelongsToTeams;
    use HasCrmFields;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'recipe_category';
    }

    public function recipes()
    {
        return $this->hasMany(\VentureDrake\LaravelCrm\Models\Recipe::class);
    }
}
