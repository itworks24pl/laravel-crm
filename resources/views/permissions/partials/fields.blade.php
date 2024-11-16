<div class="row">
    <div class="col-sm border-right">
        @include('laravel-crm::partials.form.text',[
         'name' => 'name',
         'label' => ucfirst(__('laravel-crm::lang.name')),
         'value' => old('name', $permission->name ?? null)
       ])
        @include('laravel-crm::partials.form.text',[
         'name' => 'description',
         'label' => ucfirst(__('laravel-crm::lang.description')),
         'value' => old('description', $permission->description ?? null)
       ])
        @include('laravel-crm::partials.form.checkbox-toggle',[
            'name' => 'crm_permission',
            'label' => ucfirst(__('laravel-crm::lang.crm_permission')),
            'value' =>  old('crm_permission', $permission->crm_permission ?? 1)
        ])
    </div>
</div>
