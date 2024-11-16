@component('laravel-crm::components.card')

    @component('laravel-crm::components.card-header')

        @slot('title')
            {{ $recipe->name }} 
        @endslot

        @slot('actions')

            <span class="float-right">
                @include('laravel-crm::partials.return-button',[
                    'model' => $recipe,
                    'route' => 'recipes'
                ]) | 
                @can('edit crm recipes')
                <a href="{{ url(route('laravel-crm.recipes.edit', $recipe)) }}" type="button" class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></a>
                @endcan
                @can('delete crm recipes')
                <form action="{{ route('laravel-crm.recipes.destroy',$recipe) }}" method="POST" class="form-check-inline mr-0 form-delete-button">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-sm" type="submit" data-model="{{ __('laravel-crm::lang.recipe') }}"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                </form>
                @endcan    
            </span>
            
        @endslot

    @endcomponent

    @component('laravel-crm::components.card-body')

        <div class="row">
            <div class="col-sm-6 border-right">
                <h6 class="text-uppercase">{{ ucfirst(__('laravel-crm::lang.details')) }}</h6>
                <hr />
                <dl class="row">
                    <dt class="col-sm-3 text-right">{{ strtoupper(__('laravel-crm::lang.sku')) }}</dt>
                    <dd class="col-sm-9">{{ $recipe->code }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('laravel-crm::lang.barcode')) }}</dt>
                    <dd class="col-sm-9">{{ $recipe->barcode }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('laravel-crm::lang.unit')) }}</dt>
                    <dd class="col-sm-9">{{ $recipe->unit }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('laravel-crm::lang.category')) }}</dt>
                    <dd class="col-sm-9">{{ $recipe->recipeCategory->name ?? null }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('laravel-crm::lang.description')) }}</dt>
                    <dd class="col-sm-9">{{ $recipe->description }}</dd>
                </dl>
                <h6 class="text-uppercase mt-4">{{ ucfirst(__('laravel-crm::lang.owner')) }}</h6>
                <hr />
                <dl class="row">
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('laravel-crm::lang.name')) }}</dt>
                    <dd class="col-sm-9">
                        @if($recipe->ownerUser)<a href="{{ route('laravel-crm.users.show', $recipe->ownerUser) }}">{{ $recipe->ownerUser->name ?? null }}</a> @else  {{ ucfirst(__('laravel-crm::lang.unallocated')) }} @endif
                    </dd>
                </dl>
            </div>
            <div class="col-sm-6">
                <h6 class="text-uppercase">{{ ucfirst(__('laravel-crm::lang.ingredients')) }}</h6>
                <table class="table table-hover">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach($recipe->ingredients as $ingredient)
                        <tr>
                            <th>{{ $ingredient->name }}</th>
                            <td>{{ $ingredient->pivot->amount }}</td>
                            <td>{{ $ingredient->pivot->unit_id }}</td>
                            <td>{{ $ingredient->pivot->notes }}</td>
                        </tr>
                    @endforeach
                    <?php /*
                    @foreach($recipe->recipePrices as $recipePrice)
                        <tr>
                            <th>{{ money($recipePrice->unit_price ?? null, $recipePrice->currency) }}</th>
                           {{-- <td>{{ money($recipePrice->cost_per_unit ?? null, $recipePrice->cost_per_unit) }}</td>
                            <td>{{ money($recipePrice->direct_cost ?? null, $recipePrice->direct_cost) }}</td>--}}
                            <td>{{ $recipePrice->currency }}</td>
                        </tr>
                    @endforeach
                    */ ?>
                    </tbody>
                </table>
               
                <h6 class="text-uppercase mt-4">{{ ucfirst(__('laravel-crm::lang.variations')) }}</h6>
                <hr />
                ...
                @can('view crm deals')
                <h6 class="text-uppercase mt-4">{{ ucfirst(__('laravel-crm::lang.deals')) }}</h6>
                <hr />
                ...
                @endcan    
            </div>
        </div>
        
    @endcomponent    

@endcomponent    