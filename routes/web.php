<?php

use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\AdminPrerequisiteController;
use App\Http\Controllers\AdminSectionController;
use App\Http\Controllers\AdminTopicController;
use App\Http\Controllers\AdminTrainerController;
use App\Http\Controllers\AdminTutorialController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\TrainerController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckPremium;
use Illuminate\Support\Facades\Route;

//Home page
Route::get('/', function () {
    return view('welcome');
})->name('home');


//Dashboard page
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//course and tutorial pages
Route::prefix('courses')->controller(CourseController::class)->name('courses.')->group(function () {
    Route::get('', 'courses')->name('index');
    Route::get('{course}', 'showCourse')->name('show');
    Route::get('tutorial/{tutorial}', 'showTutorial')->name('tutorial');
    Route::get('tutorial/{tutorial}/source', 'uploadTutorialSource')->name('tutorial.source')->middleware(CheckPremium::class);
});


// trainer pages
Route::prefix('trainers')->controller(TrainerController::class)->name('trainers.')->group(function () {
    Route::get('', 'trainers')->name('index');
    Route::get('{trainer}', 'showTrainer')->name('show');
});


// premium pages
Route::prefix('premium')->controller(PremiumController::class)->name('premium.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('subscribe', 'subscribe')->name('subscribe')->middleware('auth');
});


// tutorial comments
Route::middleware('auth')->prefix('comment')->controller(CommentController::class)->name('comment.')->group(function () {
    Route::post('store', 'store')->name('store');
    Route::post('{comment}/reply', 'reply')->name('reply');
});


// login and register pages
Route::controller(AuthenticationController::class)->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'register');
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login');
    });

    Route::post('logout', 'logout')->name('logout')->middleware("auth");
});


// administration pages
Route::middleware(AdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {

    Route::get('', function () {
        return view('admin.index');
    })->name('index');

    Route::resource('courses', AdminCourseController::class)->except(['show']);
    Route::resource('topics', AdminTopicController::class)->except(['show', 'destroy']);
    Route::resource('trainers', AdminTrainerController::class)->except(['show']);

    //sections, tutoriels et prérequis des cours
    Route::prefix('courses')->group(function () {
        Route::resource('{course}/sections', AdminSectionController::class)->except(['show']);
        Route::resource('{course}/section/{section}/tutorials', AdminTutorialController::class)->except(['index', 'show']);
        Route::resource('{course}/prerequisites', AdminPrerequisiteController::class)->except(['index', 'show']);
    });
});

