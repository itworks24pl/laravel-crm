<?php

namespace VentureDrake\LaravelCrm\Repositories;

use VentureDrake\LaravelCrm\Models\Recipe;

class RecipeRepository
{
    public function all()
    {
        return Recipe::all();
    }

    public function find($id)
    {
        return Recipe::find($id);
    }
}
