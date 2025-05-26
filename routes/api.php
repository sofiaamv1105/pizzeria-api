<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\PizzaController;
use App\Http\Controllers\api\PizzaSizeController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\BranchController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\IngredientController;
use App\Http\Controllers\api\PizzaIngredientController;
use App\Http\Controllers\api\ExtraIngredientController;
use App\Http\Controllers\api\OrderExtraIngredientController;
use App\Http\Controllers\api\OrderPizzaController;
use App\Http\Controllers\api\RawMaterialController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Controllers\api\PizzaRawMaterialController;
use App\Http\Controllers\api\PurchaseController;
use App\Http\Middleware\CheckRole;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('pizzas', PizzaController::class);
});
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/users', [UserController::class, 'index'])->middleware(CheckRole::class.':admin')->name('users.index');
Route::post('/users', [UserController::class, 'store'])->middleware(CheckRole::class.':admin')->name('users.store');
Route::get('/users/user', [UserController::class, 'create'])->name('users.create');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('users.destroy');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware(CheckRole::class.':admin')->name('users.update');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('users.edit');

Route::get('/pizzas', [PizzaController::class, 'index'])->middleware(CheckRole::class.':admin')->name('pizzas.index');
Route::post('/pizzas', [PizzaController::class, 'store'])->middleware(CheckRole::class.':admin')->name('pizzas.store');
Route::get('/pizzas/create', [PizzaController::class, 'create'])->middleware(CheckRole::class.':admin')->name('pizzas.create');
Route::delete('/pizzas/{pizza}', [PizzaController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('pizzas.destroy');
Route::put('/pizzas/{pizza}', [PizzaController::class, 'update'])->middleware(CheckRole::class.':admin')->name('pizzas.update');
Route::get('/pizzas/{pizza}/edit', [PizzaController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('pizzas.edit');

Route::get('/pizza_sizes', [PizzaSizeController::class, 'index'])->middleware(CheckRole::class.':admin')->name('pizza_sizes.index');
Route::post('/pizza_sizes', [PizzaSizeController::class, 'store'])->middleware(CheckRole::class.':admin')->name('pizza_sizes.store');
Route::get('/pizza_sizes/create', [PizzaSizeController::class, 'create'])->middleware(CheckRole::class.':admin')->name('pizza_sizes.create');
Route::delete('/pizza_sizes/{pizza_size}', [PizzaSizeController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('pizza_sizes.destroy');
Route::put('/pizza_sizes/{pizza_size}', [PizzaSizeController::class, 'update'])->middleware(CheckRole::class.':admin')->name('pizza_sizes.update');
Route::get('/pizza_sizes/{pizza_size}/edit', [PizzaSizeController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('pizza_sizes.edit');

Route::get('/clients', [ClientController::class, 'index'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('clients.index');
Route::post('/clients', [ClientController::class, 'store'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('clients.store');
Route::get('/clients/create', [ClientController::class, 'create'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('clients.create');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('clients.destroy');
Route::put('/clients/{client}', [ClientController::class, 'update'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('clients.update');
Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('clients.edit');

Route::get('/branches', [BranchController::class, 'index'])->middleware(CheckRole::class.':admin,vendedor')->name('branches.index');
Route::post('/branches', [BranchController::class, 'store'])->middleware(CheckRole::class.':admin,vendedor')->name('branches.store');
Route::get('/branches/create', [BranchController::class, 'create'])->middleware(CheckRole::class.':admin,vendedor')->name('branches.create');
Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->middleware(CheckRole::class.':admin,vendedor')->name('branches.destroy');
Route::put('/branches/{branch}', [BranchController::class, 'update'])->middleware(CheckRole::class.':admin,vendedor')->name('branches.update');
Route::get('/branches/{branch}/edit', [BranchController::class, 'edit'])->middleware(CheckRole::class.':admin,vendedor')->name('branches.edit');

Route::get('/employees', [EmployeeController::class, 'index'])->middleware(CheckRole::class.':admin')->name('employees.index');
Route::post('/employees', [EmployeeController::class, 'store'])->middleware(CheckRole::class.':admin')->name('employees.store');
Route::get('/employees/create', [EmployeeController::class, 'create'])->middleware(CheckRole::class.':admin')->name('employees.create');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('employees.destroy');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->middleware(CheckRole::class.':admin')->name('employees.update');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('employees.edit');

Route::get('/orders', [OrderController::class, 'index'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('orders.index');
Route::post('/orders', [OrderController::class, 'store'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('orders.store');
Route::get('/orders/create', [OrderController::class, 'create'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('orders.create');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('orders.destroy');
Route::put('/orders/{order}', [OrderController::class, 'update'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('orders.update');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->middleware(CheckRole::class.':admin,vendedor,cliente')->name('orders.edit');

Route::get('/ingredients', [IngredientController::class, 'index'])->middleware(CheckRole::class.':admin')->name('ingredients.index');
Route::post('/ingredients', [IngredientController::class, 'store'])->middleware(CheckRole::class.':admin')->name('ingredients.store');
Route::get('/ingredients/create', [IngredientController::class, 'create'])->middleware(CheckRole::class.':admin')->name('ingredients.create');
Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('ingredients.destroy');
Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->middleware(CheckRole::class.':admin')->name('ingredients.update');
Route::get('/ingredients/{ingredient}/edit', [IngredientController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('ingredients.edit');

Route::get('/pizza_ingredients', [PizzaIngredientController::class, 'index'])->middleware(CheckRole::class.':admin')->name('pizza_ingredients.index');
Route::post('/pizza_ingredients', [PizzaIngredientController::class, 'store'])->middleware(CheckRole::class.':admin')->name('pizza_ingredients.store');
Route::get('/pizza_ingredients/create', [PizzaIngredientController::class, 'create'])->middleware(CheckRole::class.':admin')->name('pizza_ingredients.create');
Route::delete('/pizza_ingredients/{pizza_ingredient}', [PizzaIngredientController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('pizza_ingredients.destroy');
Route::put('/pizza_ingredients/{pizza_ingredient}', [PizzaIngredientController::class, 'update'])->middleware(CheckRole::class.':admin')->name('pizza_ingredients.update');
Route::get('/pizza_ingredients/{pizza_ingredient}/edit', [PizzaIngredientController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('pizza_ingredients.edit');

Route::get('/extra_ingredients', [ExtraIngredientController::class, 'index'])->middleware(CheckRole::class.':admin')->name('extra_ingredients.index');
Route::post('/extra_ingredients', [ExtraIngredientController::class, 'store'])->middleware(CheckRole::class.':admin')->name('extra_ingredients.store');
Route::get('/extra_ingredients/create', [ExtraIngredientController::class, 'create'])->middleware(CheckRole::class.':admin')->name('extra_ingredients.create');
Route::delete('/extra_ingredients/{extra_ingredient}', [ExtraIngredientController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('extra_ingredients.destroy');
Route::put('/extra_ingredients/{extra_ingredient}', [ExtraIngredientController::class, 'update'])->middleware(CheckRole::class.':admin')->name('extra_ingredients.update');
Route::get('/extra_ingredients/{extra_ingredient}/edit', [ExtraIngredientController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('extra_ingredients.edit');

Route::get('/order_extra_ingredients', [OrderExtraIngredientController::class, 'index'])->middleware(CheckRole::class.':admin')->name('order_extra_ingredients.index');
Route::post('/order_extra_ingredients', [OrderExtraIngredientController::class, 'store'])->middleware(CheckRole::class.':admin')->name('order_extra_ingredients.store');
Route::get('/order_extra_ingredients/create', [OrderExtraIngredientController::class, 'create'])->middleware(CheckRole::class.':admin')->name('order_extra_ingredients.create');
Route::delete('/order_extra_ingredients/{order_extra_ingredient}', [OrderExtraIngredientController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('order_extra_ingredients.destroy');
Route::put('/order_extra_ingredients/{order_extra_ingredient}', [OrderExtraIngredientController::class, 'update'])->middleware(CheckRole::class.':admin')->name('order_extra_ingredients.update');
Route::get('/order_extra_ingredients/{order_extra_ingredient}/edit', [OrderExtraIngredientController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('order_extra_ingredients.edit');

Route::get('/order_pizzas', [OrderPizzaController::class, 'index'])->middleware(CheckRole::class.':admin')->name('order_pizzas.index');
Route::post('/order_pizzas', [OrderPizzaController::class, 'store'])->middleware(CheckRole::class.':admin')->name('order_pizzas.store');
Route::get('/order_pizzas/create', [OrderPizzaController::class, 'create'])->middleware(CheckRole::class.':admin')->name('order_pizzas.create');
Route::delete('/order_pizzas/{order_pizza}', [OrderPizzaController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('order_pizzas.destroy');
Route::put('/order_pizzas/{order_pizza}', [OrderPizzaController::class, 'update'])->middleware(CheckRole::class.':admin')->name('order_pizzas.update');
Route::get('/order_pizzas/{order_pizza}/edit', [OrderPizzaController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('order_pizzas.edit');

Route::get('/raw_materials', [RawMaterialController::class, 'index'])->middleware(CheckRole::class.':admin')->name('raw_materials.index');
Route::post('/raw_materials', [RawMaterialController::class, 'store'])->middleware(CheckRole::class.':admin')->name('raw_materials.store');
Route::get('/raw_materials/create', [RawMaterialController::class, 'create'])->middleware(CheckRole::class.':admin')->name('raw_materials.create');
Route::delete('/raw_materials/{raw_material}', [RawMaterialController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('raw_materials.destroy');
Route::put('/raw_materials/{raw_material}', [RawMaterialController::class, 'update'])->middleware(CheckRole::class.':admin')->name('raw_materials.update');
Route::get('/raw_materials/{raw_material}/edit', [RawMaterialController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('raw_materials.edit');

Route::get('/suppliers', [SupplierController::class, 'index'])->middleware(CheckRole::class.':admin')->name('suppliers.index');
Route::post('/suppliers', [SupplierController::class, 'store'])->middleware(CheckRole::class.':admin')->name('suppliers.store');
Route::get('/suppliers/create', [SupplierController::class, 'create'])->middleware(CheckRole::class.':admin')->name('suppliers.create');
Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('suppliers.destroy');
Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->middleware(CheckRole::class.':admin')->name('suppliers.update');
Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('suppliers.edit');

Route::get('/pizza_raw_materials', [PizzaRawMaterialController::class, 'index'])->middleware(CheckRole::class.':admin')->name('pizza_raw_materials.index');
Route::post('/pizza_raw_materials', [PizzaRawMaterialController::class, 'store'])->middleware(CheckRole::class.':admin')->name('pizza_raw_materials.store');
Route::get('/pizza_raw_materials/create', [PizzaRawMaterialController::class, 'create'])->middleware(CheckRole::class.':admin')->name('pizza_raw_materials.create');
Route::delete('/pizza_raw_materials/{pizza_raw_material}', [PizzaRawMaterialController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('pizza_raw_materials.destroy');
Route::put('/pizza_raw_materials/{pizza_raw_material}', [PizzaRawMaterialController::class, 'update'])->middleware(CheckRole::class.':admin')->name('pizza_raw_materials.update');
Route::get('/pizza_raw_materials/{pizza_raw_material}/edit', [PizzaRawMaterialController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('pizza_raw_materials.edit');

Route::get('/purchases', [PurchaseController::class, 'index'])->middleware(CheckRole::class.':admin')->name('purchases.index');
Route::post('/purchases', [PurchaseController::class, 'store'])->middleware(CheckRole::class.':admin')->name('purchases.store');
Route::get('/purchases/create', [PurchaseController::class, 'create'])->middleware(CheckRole::class.':admin')->name('purchases.create');
Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy'])->middleware(CheckRole::class.':admin')->name('purchases.destroy');
Route::put('/purchases/{purchase}', [PurchaseController::class, 'update'])->middleware(CheckRole::class.':admin')->name('purchases.update');
Route::get('/purchases/{purchases}/edit', [PurchaseController::class, 'edit'])->middleware(CheckRole::class.':admin')->name('purchases.edit');

});