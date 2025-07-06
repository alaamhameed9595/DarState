<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SessionSyncController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Website\ContactController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;



// 🌐 Public Routes
Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
Route::post('/search', [PropertyController::class, 'index'])->name('search');
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');
//website.about
route::get('/about', [PropertyController::class, 'about'])->name('website.about');
//website.services
route::get('/services', [PropertyController::class, 'services'])->name('website.services');
//website.blog
route::get('/blog', [PropertyController::class, 'blog'])->name('website.blog');
Route::get('/property/{id?}', [PropertyController::class, 'property'])->name('website.property');

Route::get('/faq', [PropertyController::class, 'faq'])->name('website.faq');
Route::get('/contact', [PropertyController::class, 'contact'])->name('website.contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);

Route::post('/api/session-sync', [SessionSyncController::class, 'store']);

Route::middleware(['auth'])->name('auth.')->group(function () {

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [NotificationController::class, 'getRecent'])->name('notifications.recent');

    // 🧑‍💼 Admin Routes
    Route::middleware('can:view users')->group(function () {
        Route::resource('/users', UserController::class)->names('users');
        Route::get('/agents', [AgentController::class, 'index'])->name('agents.index')->middleware('can:view agents');
        Route::post('/agents/{id}/approve', [AgentController::class, 'approve'])->name('agents.approve')->middleware('can:approve agents');
        Route::post('/agents/{id}/ban', [AgentController::class, 'ban'])->name('agents.ban')->middleware('can:ban agents');
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index')->middleware('can:update settings');
        Route::get('/settings/seo', [SettingsController::class, 'seo'])->name('settings.seo')->middleware('can:manage SEO');
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index')->middleware('can:view analytics');
        Route::get('/search-logs', [AnalyticsController::class, 'logs'])->name('search.logs')->middleware('can:view search logs');
    });

    Route::get('/properties/map', [PropertyController::class, 'map'])->name('properties.map');
    // 🏠 Agent Routes
    Route::middleware('can:view properties')->group(function () {

        // Properties
        Route::get('/properties', [PropertyController::class, 'manage'])->name('properties.manage');
        route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show')->middleware('can:view properties');

        Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store')->middleware('can:create properties');
        Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit')->middleware('can:edit properties');
        Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('properties.update')->middleware('can:edit properties');
        Route::delete('/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy')->middleware('can:delete properties');
        Route::get('/properties/images/{imageId}', [PropertyController::class, 'deleteImage'])->name('properties.deleteImage')->middleware('can:edit properties');
        Route::get('/properties/search', [PropertyController::class, 'search'])->name('properties.search');
        Route::get('/properties/{id}/publish', [PropertyController::class, 'publish'])->name('properties.publish')->middleware('can:publish properties');
        Route::post('/properties/{id}/feature', [PropertyController::class, 'feature'])->name('properties.feature')->middleware('can:feature properties');

        // Inquiries
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index')->middleware('can:view inquiries');
        Route::post('/inquiries/{id}/respond', [InquiryController::class, 'respond'])->name('inquiries.respond')->middleware('can:respond to inquiries');
        Route::delete('/inquiries/{id}', [InquiryController::class, 'destroy'])->name('inquiries.destroy')->middleware('can:delete inquiries');
    });
    // Features
    Route::get('/features', [FeatureController::class, 'index'])->name('features.index')->middleware('can:view features');
    Route::get('/features/create', [FeatureController::class, 'create'])->name('features.create')->middleware('can:create features');
    Route::post('/features', [FeatureController::class, 'store'])->name('features.store')->middleware('can:create features');
    Route::put('/features/{id}', [FeatureController::class, 'update'])->name('features.update')->middleware('can:edit features');
    Route::delete('/features/{id}', [FeatureController::class, 'destroy'])->name('features.destroy')->middleware('can:delete features');


    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('settings', [SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('admin.settings.update');

    Route::get('analytics', [AnalyticsController::class, 'index'])->name('admin.analytics.index');
});

require __DIR__ . '/auth.php';
