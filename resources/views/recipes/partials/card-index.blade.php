@component('laravel-crm::components.card')

    @component('laravel-crm::components.card-header')

        @slot('title')
            {{ ucfirst(__('laravel-crm::lang.recipes')) }}
        @endslot

        @slot('actions')
            @can('create crm recipes')
            <span class="float-right"><a type="button" class="btn btn-primary btn-sm" href="{{ url(route('laravel-crm.recipes.create')) }}"><span class="fa fa-plus"></span> {{ ucfirst(__('laravel-crm::lang.add_recipe')) }}</a></span>
            @endcan
        @endslot

    @endcomponent

    @component('laravel-crm::components.card-table')

        <table class="table mb-0 card-table table-hover">
            <thead>
            <tr>
                <th scope="col">{{ ucfirst(__('laravel-crm::lang.name')) }}</th>
                <th scope="col">{{ strtoupper(__('laravel-crm::lang.sku')) }}</th>
                <th scope="col">{{ ucfirst(__('laravel-crm::lang.category')) }}</th>
                <th scope="col">{{ ucfirst(__('laravel-crm::lang.unit')) }}</th>
                <th scope="col">{{ ucfirst(__('laravel-crm::lang.active')) }}</th>
                <th scope="col">{{ ucfirst(__('laravel-crm::lang.owner')) }}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($recipes as $recipe)
                <tr class="has-link" data-url="{{ url(route('laravel-crm.recipes.show',$recipe)) }}">
                    <td>{{ $recipe->name }}</td>
                    <td>{{ $recipe->code }}</td>
                    <td>{{ $recipe->recipeCategory->name ?? null }}</td>
                    <td>{{ $recipe->unit }}</td>
                    <td>{{ ($recipe->active == 1) ? 'YES' : 'NO' }}</td>
                    <td>{{ $recipe->ownerUser->name ?? ucfirst(__('laravel-crm::lang.unallocated')) }}</td>
                    <td class="disable-link text-right">
                        <a href="{{  route('laravel-crm.recipes.show',$recipe) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-eye" aria-hidden="true"></span></a>
                        <a href="{{  route('laravel-crm.recipes.edit',$recipe) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></a>
                        @can('delete crm recipes')
                        <form action="{{ route('laravel-crm.recipes.destroy',$recipe) }}" method="POST" class="form-check-inline mr-0 form-delete-button">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-sm" type="submit" data-model="{{ __('laravel-crm::lang.recipe') }}"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endcomponent

    @if($recipes instanceof \Illuminate\Pagination\LengthAwarePaginator )
        @component('laravel-crm::components.card-footer')
            {{ $recipes->links() }}
        @endcomponent
    @endif

@endcomponent
