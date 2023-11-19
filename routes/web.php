<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\CarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
<<<<<<< HEAD
});
=======
 });
>>>>>>> f42ba7ca044cd07cdd82beb081380078b8cb4c13
Route::get('test', function () {
    return " Welcome to my first route";
});

Route::get('user/{name}/{age?}', function ($name, $age = null) {
    if ($age !== null) {
        return "The UserName is : " . $name . "<br> and age is: </br>" . $age;
    } else {
        return "The UserName is : " . $name;
    }
})->whereIn('name',['perla','merna']);
Route::prefix('products')->group(function(){
    Route::get('/',function(){
    return 'products page';
    });
    Route::get('laptop',function(){
    return 'laptop product page';
    });
    Route::get('camera',function(){
    return 'camera product page';
    });
});
// About
Route::get('/about', function () {
    return 'About Us';
});
// Contact Us
Route::get('/contact-us', function () {
    return 'Contact Us';
});
// Support
Route::prefix('support')->group(function () {
    // Chat
    Route::get('/chat', function () {
        return 'Chat Support';
    });

    // Call
    Route::get('/call', function () {
        return 'Call Support';
    });

    // Ticket
    Route::get('/ticket', function () {
        return 'Ticket Support';
    });
});
// Training
Route::prefix('training')->group(function () {
    // HR
    Route::get('/hr', function () {
        return 'HR Training';
    });

    // ICT
    Route::get('/ict', function () {
        return 'ICT Training';
    });

    // Marketing
    Route::get('/marketing', function () {
        return 'Marketing Training';
    });

    // Logistics
    Route::get('/logistics', function () {
        return 'Logistics Training';
    });
});

Route :: fallback(function(){
    return redirect('/');
});

Route::get('cv', function () {
    return  view('cv');
});

Route::get('login', function () {
    return  view('login');
});

Route::post('receive', function () {
    return  "data received";
}) ->name('receive');

Route::get('test1',[ExampleController::class,'test1']);

Route::get('/add-car', [CarController::class, 'showForm'])->name('add-car-form');
Route::post('/add-car', [CarController::class, 'addCar'])->name('add-car');
Route::get('/show-car', [CarController::class, 'showCar'])->name('show-car');
