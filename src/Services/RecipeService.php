<?php

namespace VentureDrake\LaravelCrm\Services;

use Dcblogdev\Xero\Facades\Xero;
use VentureDrake\LaravelCrm\Models\Recipe;
use VentureDrake\LaravelCrm\Repositories\RecipeRepository;

class RecipeService
{
    /**
     * @var RecipeRepository
     */
    private $recipeRepository;

    /**
     * LeadService constructor.
     * @param RecipeRepository $recipeRepository
     */
    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function create($request)
    {
        $recipe = Recipe::create([
            'name' => $request->name,
            'code' => $request->code ?? null,
            'barcode' => $request->barcode ?? null,
            'purchase_account' => $request->purchase_account ?? null,
            'sales_account' => $request->sales_account ?? null,
            'recipe_category_id' => $request->recipe_category,
            'unit' => $request->unit ?? null,
            'tax_rate_id' => $request->tax_rate_id ?? null,
            'tax_rate' => $request->tax_rate ?? null,
            'description' => $request->description ?? null,
            'user_owner_id' => $request->user_owner_id,
        ]);

        $recipe->recipePrices()->create([
            'unit_price' => $request->unit_price,
            'currency' => $request->currency,
        ]);

        if (Xero::isConnected()) {
            $xeroRecipe = Xero::post('Items', [
                'Code' => $recipe->code,
                'Name' => $recipe->name,
                'Description' => $recipe->description,
                'PurchaseDetails' => [
                    'AccountCode' => $recipe->purchase_account ?? 310,
                ],
                'SalesDetails' => [
                    'UnitPrice' => ($recipe->getDefaultPrice()->unit_price) ? $recipe->getDefaultPrice()->unit_price / 100 : null,
                    'AccountCode' => $recipe->sales_account ?? 200,
                ],
            ]);

            $item = $xeroRecipe['body']['Items'][0];

            $recipe->xeroItem()->updateOrCreate([
                'item_id' => $item['ItemID'],
            ], [
                'code' => $item['Code'],
                'name' => $item['Name'],
                'inventory_tracked' => $item['IsTrackedAsInventory'],
                'is_sold' => $item['IsSold'],
                'is_purchased' => $item['IsPurchased'],
                'purchase_price' => (isset($item['PurchaseDetails']['UnitPrice'])) ? $item['PurchaseDetails']['UnitPrice'] : null,
                'sell_price' => (isset($item['SalesDetails']['UnitPrice'])) ? $item['SalesDetails']['UnitPrice'] : null,
                'purchase_description' => $item['PurchaseDescription'] ?? null,
            ]);
        }

        return $recipe;
    }

    public function update(Recipe $recipe, $request)
    {
        $recipe->update([
            'name' => $request->name,
            'code' => $request->code ?? null,
            'barcode' => $request->barcode ?? null,
            'purchase_account' => $request->purchase_account ?? null,
            'sales_account' => $request->sales_account ?? null,
            'recipe_category_id' => $request->recipe_category,
            'unit' => $request->unit ?? null,
            'tax_rate_id' => $request->tax_rate_id ?? null,
            'tax_rate' => $request->tax_rate ?? null,
            'description' => $request->description ?? null,
            'user_owner_id' => $request->user_owner_id,
        ]);

        $recipePrice = $recipe->getDefaultPrice();

        if ($recipePrice) {
            $recipePrice->update([
                'unit_price' => $request->unit_price,
            ]);
        } else {
            $recipe->recipePrices()->create([
                'unit_price' => $request->unit_price,
                'currency' => $request->currency,
            ]);
        }

        if (Xero::isConnected()) {
            $xeroRecipe = Xero::post('Items', [
                'ItemID' => $recipe->xeroItem->item_id ?? null,
                'Code' => $recipe->code,
                'Name' => $recipe->name,
                'Description' => $recipe->description,
                'PurchaseDetails' => [
                    'AccountCode' => $recipe->purchase_account ?? 310,
                ],
                'SalesDetails' => [
                    'UnitPrice' => ($recipe->getDefaultPrice()->unit_price) ? $recipe->getDefaultPrice()->unit_price / 100 : null,
                    'AccountCode' => $recipe->sales_account ?? 200,
                ],
            ]);

            $item = $xeroRecipe['body']['Items'][0];

            $recipe->xeroItem()->updateOrCreate([
                'item_id' => $item['ItemID'],
            ], [
                'code' => $item['Code'],
                'name' => $item['Name'],
                'inventory_tracked' => $item['IsTrackedAsInventory'],
                'is_sold' => $item['IsSold'],
                'is_purchased' => $item['IsPurchased'],
                'purchase_price' => (isset($item['PurchaseDetails']['UnitPrice'])) ? $item['PurchaseDetails']['UnitPrice'] : null,
                'sell_price' => (isset($item['SalesDetails']['UnitPrice'])) ? $item['SalesDetails']['UnitPrice'] : null,
                'purchase_description' => $item['PurchaseDescription'] ?? null,
            ]);
        }

        return $recipe;
    }
}
