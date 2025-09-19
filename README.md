<!-- Create a new Application for employee -->
laravel new laravel_splade

<!-- Run the composer command  ============== https://splade.dev/docs/breeze -->
composer require protonemedia/laravel-splade-breeze

<!-- Install breeze -->
php artisan breeze:install

<!-- Build the frontend assets -->
npm install
npm run dev

<!-- Create migration  -->
```php
<!-- Add these lines in the User migration -->
    $table->string('username');
    $table->string('first_name');
    $table->string('last_name');
```

<!-- Country, State, City, Department, Employee -->
php artisan make:model Country -m

<!-- Add the field and migrate the table -->
php artisan migrate

<!-- Edit the file -->
register.blade.php
RegisteredUserController.php
User.php
Navigation.blade.php
update-profile-information-form-blade.php

<!-- Create Component-->
app.blade.php    copy     admin.blade.php
Applayout.php    copy     Admin.blade.php  (Rename ClassName)   // App\View\Components;

<!-- Add the Components file in the js/components/Sidebar.vue -->
<!-- Import the file in the js/app.js -->
import Sidebar from "./components/Sidebar.vue";
.component('sidebar', Sidebar)

<!--  -->
<!-- put the code in the Sidebar.vue -->
<script setup>

</script>
<template>
    code here
</template>

<!-- Create AdminController -->
php artisan make:controller AdminController

<!-- Make the Route -->
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

<!-- Make resource Controller   -->
php artisan make:controller UsersController --resource
php artisan make:controller StatesController --resource
php artisan make:controller CitiesController --resource
php artisan make:controller CountriesController --resource
php artisan make:controller DepartmentsController --resource
php artisan make:controller EmployeesController --resource

<!-- Create Table Component     https://splade.dev/docs/table-overview -->
php artisan make:table Users

<!-- use to make better     https://spatie.be/docs/laravel-query-builder/v5/installation-setup -->
composer require spatie/laravel-query-builder
php artisan vendor:publish --provider="Spatie\QueryBuilder\QueryBuilderServiceProvider

<!-- Edit user factory file  -->
return [
            'username' => fake()->name(),
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

<!-- Edit database seeder file -->
User::factory(100)->create();

<!-- Seed the file -->
php artisan db:seed

<!-- Create update user request -->
php artisan make:request UpdateUserRequest

<!-- Create store user request -->
php artisan make:request StoreUserRequest

<!-- For delete User Read Splade Doc https://splade.dev/docs/x-link for confirm delete -->
<Link confirm href="{{ route('admin.users.destroy', $users) }}" method="DELETE" </Link>
<!-- Custom Confirm message while delete the user https://splade.dev/docs/x-link -->
<Link
    confirm="Enter the danger zone..."
    confirm-text="Are you sure?"
    confirm-button="Yes, take me there!"
    cancel-button="No, keep me save!"
    href="/danger">
    Danger Zone
</Link>

<!-- Countries -->
<!-- Create Countries table -->
php artisan make:table countries

<!-- Create store country request -->
php artisan make:request StoreCountryRequest

<!-- Create update country request -->
php artisan make:request UpdateCountryRequest


<!-- States -->
<!-- Create States table -->
php artisan make:table states

<!-- Create store State request -->
php artisan make:request StoreStateRequest

<!-- Create update State request -->
php artisan make:request UpdateStateRequest

<!-- States.php   table  // Show the column  -->
<!-- $table->column(key: 'country.name', label:'Country');      -->
https://splade.dev/docs/table-query-builder    // URl

<!-- Select filter  -->
 <!-- 
    $table->selectFilter(
            key: 'language_code',
            options: Country::pluck('name', 'id')->toArray(),    // Show the name first
            label: 'Country'
        ) 
-->

<!-- Create form https://splade.dev/docs/form-builder-overview -->
php artisan make:form CreateStateForm
php artisan make:form UpdateStateForm


<!-- cities -->
<!-- Create cities table -->
php artisan make:table Cities

<!-- cities.php   table  // Show the column  -->
<!-- $table->column(key: 'country.name', label:'Country');      -->
https://splade.dev/docs/table-query-builder    // URl

<!-- Select filter  -->
 <!-- 
    $table->selectFilter(
            key: 'language_code',
            options: Country::pluck('name', 'id')->toArray(),    // Show the name first
            label: 'Country'
        ) 
-->

<!-- Create form https://splade.dev/docs/form-builder-overview -->
php artisan make:form CreateCitiesForm
php artisan make:form UpdateCitiesForm

<!-- Create Departments table -->
php artisan make:table Departments

<!-- Create form https://splade.dev/docs/form-builder-overview -->
php artisan make:form CreateDepartmentsForm
php artisan make:form UpdateDepartmentsForm

<!-- Create Employees table -->
php artisan make:table Employees

<!-- Create form https://splade.dev/docs/form-builder-overview -->
php artisan make:form CreateEmployeesForm
php artisan make:form UpdateEmployeesForm

<!-- Admin Role and permission -->
https://spatie.be/docs/laravel-permission/v5/installation-laravel

<!-- install  -->
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan optimize:clear
php artisan migrate

<!-- Next step  -->
https://spatie.be/docs/laravel-permission/v5/basic-usage/basic-usage

<!-- Add in the DB seed -->
 User::factory(100)->create();
        
       ```php
        $role = Role::create(['name' => 'writer']);

        $user = User::factory()->create([
            'first_name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        $user->assignRole($role);
       ```

<!-- DB:seed -->
php artisan db:seed

<!-- Add the guard to protect routes -->
https://spatie.be/docs/laravel-permission/v5/basic-usage/middleware

<!-- Add the middleware -->
Route::middleware(['auth', 'role:Admin'])

<!-- Add icons -->
https://heroicons.com/

<!-- Create controller for Role and permission -->
php artisan make:controller RoleController
php artisan make:controller PermissionController

<!-- Create table for Roles and Permissions-->
php artisan make:table Roles
php artisan make:table Permissions

<!-- Import the Role model  in the Roles table -->
use Spatie\Permission\Models\Role;

<!-- Hide the Admin role from the role index page -->
Add the condition in the Roles Table
<!-- QueryBuilder::for(Role::where('name', '!=', 'Admin')) -->

<!-- Hide Admin user in the Users table  -->
 return QueryBuilder::for(User::whereDoesntHave('roles', function($q){
            $q->where('name', 'admin');
        }))


<!-- Create Request for Create and Update -->
php artisan make:request CreateRoleRequest
php artisan make:request UpdateRoleRequest

php artisan make:request CreatePermissionRequest
php artisan make:request UpdatePermissionRequest

<!-- Sync Permissions To A Role -->
https://spatie.be/docs/laravel-permission/v5/basic-usage/basic-usage

<!-- Add the Relation  https://splade.dev/docs/form-select  to see the seected data-->
<x-splade-select name="tags[]" :options="$tags" multiple relation choices />
