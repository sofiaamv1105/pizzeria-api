<?php

use App\Http\Controllers\api\BranchController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\ExtraIngredientController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\OrderExtraIngredientController;
use App\Http\Controllers\api\OrderPizzaController;
use App\Http\Controllers\api\PizzaIngredientController;
use App\Http\Controllers\api\PizzaRawMaterialController;
use App\Http\Controllers\api\PizzaController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\PurchaseController;
use App\Http\Controllers\api\PizzaSizeController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\RawMaterialController;
use App\Http\Controllers\api\IngredientController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas de branchs
Route::get('/branches', [BranchController::class, 'index'])->name('branch');
Route::post('/branches', [BranchController::class, 'store'])->name('branch.store');
Route::get('/branches/{branch}', [BranchController::class, 'show'])->name('branch.show');
Route::put('/branches/{branch}', [BranchController::class, 'update'])->name('branch.update');
Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->name('orders.destroy');

// Rutas de clients
Route::get('/clients', [ClientController::class, 'index'])->name('clients');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

// Rutas de employees
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

// Rutas de extra_ingredients
Route::get('/extra_ingredients', [ExtraIngredientController::class, 'index'])->name('extra_ingredients');
Route::post('/extra_ingredients', [ExtraIngredientController::class, 'store'])->name('extra_ingredients.store');
Route::get('/extra_ingredients/{extra_ingredient}', [ExtraIngredientController::class, 'show'])->name('extra_ingredients.show');
Route::put('/extra_ingredients/{extra_ingredient}', [ExtraIngredientController::class, 'update'])->name('extra_ingredients.update');
Route::delete('/extra_ingredients/{extra_ingredient}', [ExtraIngredientController::class, 'destroy'])->name('extra_ingredients.destroy');

// Rutas de orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

// Rutas de order_extra_ingredients
Route::get('/order_extra_ingredients', [OrderExtraIngredientController::class, 'index'])->name('order_extra_ingredients');
Route::post('/order_extra_ingredients', [OrderExtraIngredientController::class, 'store'])->name('order_extra_ingredients.store');
Route::get('/order_extra_ingredients/{order_extra_ingredient}', [OrderExtraIngredientController::class, 'show'])->name('order_extra_ingredients.show');
Route::put('/order_extra_ingredients/{order_extra_ingredient}', [OrderExtraIngredientController::class, 'update'])->name('order_extra_ingredients.update');
Route::delete('/order_extra_ingredients/{order_extra_ingredient}', [OrderExtraIngredientController::class, 'destroy'])->name('order_extra_ingredients.destroy');

// Rutas de order_pizzas
Route::get('/order_pizzas', [OrderPizzaController::class, 'index'])->name('order_pizzas');
Route::post('/order_pizzas', [OrderPizzaController::class, 'store'])->name('order_pizzas.store');
Route::get('/order_pizzas/{order_pizza}', [OrderPizzaController::class, 'show'])->name('order_pizzas.show');
Route::put('/order_pizzas/{order_pizza}', [OrderPizzaController::class, 'update'])->name('order_pizzas.update');
Route::delete('/order_pizzas/{order_pizza}', [OrderPizzaController::class, 'destroy'])->name('order_pizzas.destroy');

// Rutas de pizza_ingredients
Route::get('/pizza_ingredients', [PizzaIngredientController::class, 'index'])->name('pizza_ingredients');
Route::post('/pizza_ingredients', [PizzaIngredientController::class, 'store'])->name('pizza_ingredients.store');
Route::get('/pizza_ingredients/{pizza_ingredient}', [PizzaIngredientController::class, 'show'])->name('pizza_ingredients.show');
Route::put('/pizza_ingredients/{pizza_ingredient}', [PizzaIngredientController::class, 'update'])->name('pizza_ingredients.update');
Route::delete('/pizza_ingredients/{pizza_ingredient}', [PizzaIngredientController::class, 'destroy'])->name('pizza_ingredients.destroy');

// Rutas de pizza raw materials
Route::get('/pizza-raw-materials', [PizzaRawMaterialController::class, 'index'])->name('pizza-raw-materials');
Route::post('/pizza-raw-materials', [PizzaRawMaterialController::class, 'store'])->name('pizza-raw-materials.store');
Route::get('/pizza-raw-materials/{id}', [PizzaRawMaterialController::class, 'show'])->name('pizza-raw-materials.show');
Route::put('/pizza-raw-materials/{id}', [PizzaRawMaterialController::class, 'update'])->name('pizza-raw-materials.update');
Route::delete('/pizza-raw-materials/{id}', [PizzaRawMaterialController::class, 'destroy'])->name('pizza-raw-materials.destroy');

// Rutas de pizzas
Route::get('/pizzas', [PizzaController::class, 'index'])->name('pizzas');
Route::post('/pizzas', [PizzaController::class, 'store'])->name('pizzas.store');
Route::get('/pizzas/{pizza}', [PizzaController::class, 'show'])->name('pizzas.show');
Route::put('/pizzas/{pizza}', [PizzaController::class, 'update'])->name('pizzas.update');
Route::delete('/pizzas/{pizza}', [PizzaController::class, 'destroy'])->name('pizzas.destroy');

// Rutas de users
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Rutas de purchases
Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases');
Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
Route::get('/purchases/{id}', [PurchaseController::class, 'show'])->name('purchases.show');
Route::put('/purchases/{id}', [PurchaseController::class, 'update'])->name('purchases.update');
Route::delete('/purchases/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');

// Rutas de raw materials
Route::get('/raw-materials', [RawMaterialController::class, 'index'])->name('raw-materials');
Route::post('/raw-materials', [RawMaterialController::class, 'store'])->name('raw-materials.store');
Route::get('/raw-materials/{id}', [RawMaterialController::class, 'show'])->name('raw-materials.show');
Route::put('/raw-materials/{id}', [RawMaterialController::class, 'update'])->name('raw-materials.update');
Route::delete('/raw-materials/{id}', [RawMaterialController::class, 'destroy'])->name('raw-materials.destroy');

// Rutas de suppliers
Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');
Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
Route::get('/suppliers/{id}', [SupplierController::class, 'show'])->name('suppliers.show');
Route::put('/suppliers/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

// Rutas de pizza_sizes
Route::get('/pizza-sizes', [PizzaSizeController::class, 'index'])->name('pizza-sizes');
Route::post('/pizza-sizes', [PizzaSizeController::class, 'store'])->name('pizza-sizes.store');
Route::get('/pizza-sizes/{id}', [PizzaSizeController::class, 'show'])->name('pizza-sizes.show');
Route::put('/pizza-sizes/{id}', [PizzaSizeController::class, 'update'])->name('pizza-sizes.update');
Route::delete('/pizza-sizes/{id}', [PizzaSizeController::class, 'destroy'])->name('pizza-sizes.destroy');

// Rutas de ingredients
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients');
Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
Route::get('/ingredients/{id}', [IngredientController::class, 'show'])->name('ingredients.show');
Route::put('/ingredients/{id}', [IngredientController::class, 'update'])->name('ingredients.update');
Route::delete('/ingredients/{id}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');