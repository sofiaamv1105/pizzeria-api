<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\PizzaSizeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PizzaIngredientController;
use App\Http\Controllers\ExtraIngredientController;
use App\Http\Controllers\OrderExtraIngredientController;
use App\Http\Controllers\OrderPizzaController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PizzaRawMaterialController;
use App\Http\Controllers\PurchaseController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('pizzas', PizzaController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/user', [UserController::class, 'create'])->name('users.create');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::get('/pizzas', [PizzaController::class, 'index'])->name('pizzas.index');
Route::post('/pizzas', [PizzaController::class, 'store'])->name('pizzas.store');
Route::get('/pizzas/create', [PizzaController::class, 'create'])->name('pizzas.create');
Route::delete('/pizzas/{pizza}', [PizzaController::class, 'destroy'])->name('pizzas.destroy');
Route::put('/pizzas/{pizza}', [PizzaController::class, 'update'])->name('pizzas.update');
Route::get('/pizzas/{pizza}/edit', [PizzaController::class, 'edit'])->name('pizzas.edit');

Route::get('/pizza_sizes', [PizzaSizeController::class, 'index'])->name('pizza_sizes.index');
Route::post('/pizza_sizes', [PizzaSizeController::class, 'store'])->name('pizza_sizes.store');
Route::get('/pizza_sizes/create', [PizzaSizeController::class, 'create'])->name('pizza_sizes.create');
Route::delete('/pizza_sizes/{pizza_size}', [PizzaSizeController::class, 'destroy'])->name('pizza_sizes.destroy');
Route::put('/pizza_sizes/{pizza_size}', [PizzaSizeController::class, 'update'])->name('pizza_sizes.update');
Route::get('/pizza_sizes/{pizza_size}/edit', [PizzaSizeController::class, 'edit'])->name('pizza_sizes.edit');

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');

Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');
Route::put('/branches/{branch}', [BranchController::class, 'update'])->name('branches.update');
Route::get('/branches/{branch}/edit', [BranchController::class, 'edit'])->name('branches.edit');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');

Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');
Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');
Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredients.update');
Route::get('/ingredients/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredients.edit');

Route::get('/pizza_ingredients', [PizzaIngredientController::class, 'index'])->name('pizza_ingredients.index');
Route::post('/pizza_ingredients', [PizzaIngredientController::class, 'store'])->name('pizza_ingredients.store');
Route::get('/pizza_ingredients/create', [PizzaIngredientController::class, 'create'])->name('pizza_ingredients.create');
Route::delete('/pizza_ingredients/{pizza_ingredient}', [PizzaIngredientController::class, 'destroy'])->name('pizza_ingredients.destroy');
Route::put('/pizza_ingredients/{pizza_ingredient}', [PizzaIngredientController::class, 'update'])->name('pizza_ingredients.update');
Route::get('/pizza_ingredients/{pizza_ingredient}/edit', [PizzaIngredientController::class, 'edit'])->name('pizza_ingredients.edit');

Route::get('/extra_ingredients', [ExtraIngredientController::class, 'index'])->name('extra_ingredients.index');
Route::post('/extra_ingredients', [ExtraIngredientController::class, 'store'])->name('extra_ingredients.store');
Route::get('/extra_ingredients/create', [ExtraIngredientController::class, 'create'])->name('extra_ingredients.create');
Route::delete('/extra_ingredients/{extra_ingredient}', [ExtraIngredientController::class, 'destroy'])->name('extra_ingredients.destroy');
Route::put('/extra_ingredients/{extra_ingredient}', [ExtraIngredientController::class, 'update'])->name('extra_ingredients.update');
Route::get('/extra_ingredients/{extra_ingredient}/edit', [ExtraIngredientController::class, 'edit'])->name('extra_ingredients.edit');

Route::get('/order_extra_ingredients', [OrderExtraIngredientController::class, 'index'])->name('order_extra_ingredients.index');
Route::post('/order_extra_ingredients', [OrderExtraIngredientController::class, 'store'])->name('order_extra_ingredients.store');
Route::get('/order_extra_ingredients/create', [OrderExtraIngredientController::class, 'create'])->name('order_extra_ingredients.create');
Route::delete('/order_extra_ingredients/{order_extra_ingredient}', [OrderExtraIngredientController::class, 'destroy'])->name('order_extra_ingredients.destroy');
Route::put('/order_extra_ingredients/{order_extra_ingredient}', [OrderExtraIngredientController::class, 'update'])->name('order_extra_ingredients.update');
Route::get('/order_extra_ingredients/{order_extra_ingredient}/edit', [OrderExtraIngredientController::class, 'edit'])->name('order_extra_ingredients.edit');

Route::get('/order_pizzas', [OrderPizzaController::class, 'index'])->name('order_pizzas.index');
Route::post('/order_pizzas', [OrderPizzaController::class, 'store'])->name('order_pizzas.store');
Route::get('/order_pizzas/create', [OrderPizzaController::class, 'create'])->name('order_pizzas.create');
Route::delete('/order_pizzas/{order_pizza}', [OrderPizzaController::class, 'destroy'])->name('order_pizzas.destroy');
Route::put('/order_pizzas/{order_pizza}', [OrderPizzaController::class, 'update'])->name('order_pizzas.update');
Route::get('/order_pizzas/{order_pizza}/edit', [OrderPizzaController::class, 'edit'])->name('order_pizzas.edit');

Route::get('/raw_materials', [RawMaterialController::class, 'index'])->name('raw_materials.index');
Route::post('/raw_materials', [RawMaterialController::class, 'store'])->name('raw_materials.store');
Route::get('/raw_materials/create', [RawMaterialController::class, 'create'])->name('raw_materials.create');
Route::delete('/raw_materials/{raw_material}', [RawMaterialController::class, 'destroy'])->name('raw_materials.destroy');
Route::put('/raw_materials/{raw_material}', [RawMaterialController::class, 'update'])->name('raw_materials.update');
Route::get('/raw_materials/{raw_material}/edit', [RawMaterialController::class, 'edit'])->name('raw_materials.edit');

Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');

Route::get('/pizza_raw_materials', [PizzaRawMaterialController::class, 'index'])->name('pizza_raw_materials.index');
Route::post('/pizza_raw_materials', [PizzaRawMaterialController::class, 'store'])->name('pizza_raw_materials.store');
Route::get('/pizza_raw_materials/create', [PizzaRawMaterialController::class, 'create'])->name('pizza_raw_materials.create');
Route::delete('/pizza_raw_materials/{pizza_raw_material}', [PizzaRawMaterialController::class, 'destroy'])->name('pizza_raw_materials.destroy');
Route::put('/pizza_raw_materials/{pizza_raw_material}', [PizzaRawMaterialController::class, 'update'])->name('pizza_raw_materials.update');
Route::get('/pizza_raw_materials/{pizza_raw_material}/edit', [PizzaRawMaterialController::class, 'edit'])->name('pizza_raw_materials.edit');

Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
Route::put('/purchases/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
Route::get('/purchases/{purchases}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
