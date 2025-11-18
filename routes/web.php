<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route untuk halaman utama (Beranda)
Route::get('/', [GalleryController::class, 'home'])->name('home');

// Public Gallery Routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/category/{category}', [GalleryController::class, 'category'])->name('gallery.category');
Route::get('/gallery/photos', [GalleryController::class, 'photos'])->name('gallery.photos');
Route::get('/gallery/photo/{id}/download', [GalleryController::class, 'downloadPhoto'])->name('gallery.photo.download');

// Comment Routes
Route::middleware('web')->group(function () {
    Route::post('/photo/{photoId}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy')->middleware('auth');
});

// Like Routes
Route::middleware('web')->group(function () {
    Route::post('/photo/{photoId}/like', [LikeController::class, 'toggle'])->name('photo.like');
});

// Public Information Route
Route::get('/information', [GalleryController::class, 'informationPage'])->name('information.page');

// Admin Login Routes
Route::middleware(['guest', 'web'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('web');
Route::post('/gallery-logout', [AuthController::class, 'galleryLogout'])->name('gallery.logout')->middleware('web');

// User Authentication Routes
Route::middleware(['guest', 'web'])->group(function () {
    Route::get('/user/login', [AuthController::class, 'showUserLogin'])->name('user.login');
    Route::post('/user/login', [AuthController::class, 'userLogin'])->name('user.login.post');
});

// Simple login page for testing
Route::get('/login-simple', function () {
    return view('auth.login-simple');
})->name('login.simple');

// DEBUG ROUTE - Test login directly
Route::get('/test-direct-login', function () {
    $user = \App\Models\User::where('username', 'admin')->first();
    
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }
    
    // Test password
    $passwordTest = \Illuminate\Support\Facades\Hash::check('admin123', $user->password);
    
    if (!$passwordTest) {
        return response()->json(['error' => 'Password mismatch'], 401);
    }
    
    // Try to login
    \Illuminate\Support\Facades\Auth::login($user);
    
    // Check if authenticated
    $isAuth = \Illuminate\Support\Facades\Auth::check();
    
    if ($isAuth) {
        return redirect()->route('admin.dashboard');
    } else {
        return response()->json(['error' => 'Auth failed after login'], 500);
    }
})->name('test.direct.login');

// User Registration Routes
Route::middleware(['guest', 'web'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    Route::post('/register/check-username', [RegisterController::class, 'checkUsername'])->name('register.checkUsername');
    Route::post('/register/check-email', [RegisterController::class, 'checkEmail'])->name('register.checkEmail');
});

// Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware(['web', 'auth', 'admin']);

// Photo Management Routes (Admin only)
Route::middleware(['web', 'auth', 'admin'])->group(function () {
    Route::get('/admin/photos', [PhotoController::class, 'index'])->name('admin.photos.index');
    Route::post('/admin/photos', [PhotoController::class, 'store'])->name('admin.photos.store');
    Route::get('/admin/photos/{id}/edit', [PhotoController::class, 'edit'])->name('admin.photos.edit');
    Route::put('/admin/photos/{id}', [PhotoController::class, 'update'])->name('admin.photos.update');
    Route::delete('/admin/photos/{id}', [PhotoController::class, 'destroy'])->name('admin.photos.destroy');
    
    // Information Management Routes (Admin only)
    Route::prefix('admin')->group(function () {
        Route::get('/information', [InformationController::class, 'index'])->name('admin.information.index');
        Route::get('/information/create', [InformationController::class, 'create'])->name('admin.information.create');
        Route::post('/information', [InformationController::class, 'store'])->name('admin.information.store');
        Route::get('/information/{id}/edit', [InformationController::class, 'edit'])->name('admin.information.edit');
        Route::put('/information/{id}', [InformationController::class, 'update'])->name('admin.information.update');
        Route::delete('/information/{id}', [InformationController::class, 'destroy'])->name('admin.information.destroy');
        Route::patch('/information/{id}/toggle-publish', [InformationController::class, 'togglePublish'])->name('admin.information.toggle-publish');
        
        // Statistics Routes (Admin only)
        Route::get('/statistics', [StatisticsController::class, 'index'])->name('admin.statistics.index');
        Route::get('/statistics/pdf', [StatisticsController::class, 'generatePdf'])->name('admin.statistics.pdf');
        
        // Notification Routes (Admin only)
        Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
        Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('admin.notifications.unread-count');
        Route::get('/notifications/recent', [NotificationController::class, 'getRecent'])->name('admin.notifications.recent');
        Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.read');
        Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('admin.notifications.read-all');
        Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('admin.notifications.destroy');
    });
});

// User Routes
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
});
