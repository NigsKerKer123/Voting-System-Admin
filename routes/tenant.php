<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\PartylistController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VotersController;
use App\Http\Controllers\votesController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\CastedController;
use App\Http\Controllers\generateReportController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    'auth',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    // Route::get('/', function (){return redirect('/dashboard');});
    Route::get('/dashboard', [adminController::class, 'dashboard'])->name('dashboard.index');
    Route::get('/sboVotes', [votesController::class, 'sbo'])->name('sboVotes.index');
    Route::get('/sscVotes', [votesController::class, 'ssc'])->name('sscVotes.index');

    //customize & upgrade
    Route::post('/customize', [adminController::class, 'customize'])->name('customize');
    Route::post('/upgrade', [adminController::class, 'upgrade'])->name('upgrade');

    //College API Route
    Route::controller(CollegeController::class)->group(function () {
        Route::get('/colleges', 'index')->name('college.index');
        Route::get('/colleges/search', 'search')->name('college.search');
        Route::post('/colleges/add', 'add')->name('college.add');
        Route::put('/colleges/edit', 'edit')->name('college.edit');
        Route::delete('/colleges/deleteOne', 'deleteOne')->name('college.deleteOne');
    });

    //partylist API Route
    Route::controller(PartylistController::class)->group(function () {
        Route::get('/partylists', 'index')->name('partylist.index');
        Route::get('/partylists/search', 'search')->name('partylist.search');
        Route::post('/partylists/add', 'add')->name('partylist.add');
        Route::put('/partylists/edit', 'edit')->name('partylist.edit');
        Route::delete('/partylists/deleteOne', 'deleteOne')->name('partylist.deleteOne');
    });

    //organization API Route
    Route::controller(OrganizationController::class)->group(function () {
        Route::get('/organizations', 'index')->name('organization.index');
        Route::get('/organizations/search', 'search')->name('organization.search');
        Route::post('/organizations/add', 'add')->name('organization.add');
        Route::put('/organizations/edit', 'edit')->name('organization.edit');
        Route::delete('/organizations/deleteOne', 'deleteOne')->name('organization.deleteOne');
    });

    //position API Route
    Route::controller(PositionController::class)->group(function () {
        Route::get('/positions', 'index')->name('position.index');
        Route::get('/positions/search', 'search')->name('position.search');
        Route::post('/positions/add', 'add')->name('position.add');
        Route::put('/positions/edit', 'edit')->name('position.edit');
        Route::delete('/positions/deleteOne', 'deleteOne')->name('position.deleteOne');
    });

    //candidates API Route
    Route::controller(CandidateController::class)->group(function () {
        Route::get('/candidates', 'index')->name('candidates.index');
        Route::get('/candidates/search', 'search')->name('candidates.search');
        Route::post('/candidates/add', 'add')->name('candidates.add');
        Route::put('/candidates/edit', 'edit')->name('candidates.edit');
        Route::delete('/candidates/deleteOne', 'deleteOne')->name('candidates.deleteOne');
    });

    //voters API Route
    Route::controller(VotersController::class)->group(function () {
        Route::get('/voters', 'index')->name('voters.index');
        Route::get('/voters/search', 'search')->name('voters.search');
        Route::post('/voters/add', 'add')->name('voters.add');
        Route::put('/voters/edit', 'edit')->name('voters.edit');
        Route::post('/voters/passkey', 'regeneratePasskey')->name('voters.passkey');
        Route::delete('/voters/deleteOne', 'deleteOne')->name('voters.deleteOne');
        Route::get('/hash', 'hash');
    });

    Route::controller(CastedController::class)->group(function () {
        Route::get('/castedVotes', 'index')->name('castedVotes.index');
    });

    Route::controller(generateReportController::class)->group(function () {
        Route::post('/generate', 'generate')->name('generate');
        Route::post('/generateSBO', 'generateSBO')->name('generateSBO');
    });
});
