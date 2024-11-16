<?php

namespace VentureDrake\LaravelCrm\Models;

class IngredientToRecipe extends Model {

    protected $guarded = ['recipe_id', 'ingredient_id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'ingredient_to_recipe';
    }

    public function getUnit(){
        return 'kg';
    }

}