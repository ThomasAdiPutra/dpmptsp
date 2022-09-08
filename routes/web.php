<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RelatedLinkController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServicePermissionController;
use App\Http\Controllers\ServicePermissionFormController;
use App\Http\Controllers\SKMController;
use App\Http\Controllers\SKMIndicatorController;
use App\Http\Controllers\SKMResultController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('berita', NewsController::class)->except(['index', 'show']);
    Route::resource('kategori', CategoryController::class)->except(['create', 'show', 'edit']);
    Route::get('berita/all', [NewsController::class, 'indexForUser'])->name('berita.all');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('images/upload')->group(function () {
        Route::post('news', function (Request $request) {
            $path = base_path('') . '/public/asset/img/news/content/';
            $name = date('Y-m-d') . '-' . uniqid() . $request->file->getClientOriginalName();
            move_uploaded_file($request->file, $path . $name);
            return response()->json([
                'location' => asset('/asset/img/news/content/' . $name),
            ]);
        })->name('images.upload.news');

        Route::post('announcement', function (Request $request) {
            $path = base_path('') . '/public/asset/img/announcement/';
            $name = date('Y-m-d') . '-' . uniqid() . $request->file->getClientOriginalName();
            move_uploaded_file($request->file, $path . $name);
            return response()->json([
                'location' => asset('/asset/img/announcement/' . $name),
            ]);
        })->name('images.upload.announcement');
    });

    Route::resource('kontak', ContactController::class)->only(['store']);
    Route::get('kontak/all', [ContactController::class, 'indexForUser'])->name('kontak.all');
    Route::match(['PUT', 'PATCH'], '/kontak', [ContactController::class, 'update'])->name('kontak.update');

    Route::resource('tentang', AboutController::class)->only('index');
    Route::match(['PUT', 'PATCH'], '/tentang', [AboutController::class, 'update'])->name('about.update');

    Route::resource('pengumuman', AnnouncementController::class);

    Route::resource('carousel', CarouselController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('galeri', GalleryController::class)->except(['index', 'show']);
    Route::get('galeri/all', [GalleryController::class, 'indexForUser'])->name('galeri.all');

    Route::get('pengaduan/all', [ComplaintController::class, 'indexForUser'])->name('pengaduan.all');
    Route::patch('pengaduan/toggle/{pengaduan}', [ComplaintController::class, 'toggleActive']);
    Route::post('pengaduan/reply', [ComplaintController::class, 'storeReply'])->name('pengaduan.reply');
    Route::resource('pengaduan', ComplaintController::class)->only(['destroy']);
    Route::get('pengaduan/detail/{pengaduan}', [ComplaintController::class, 'detail'])->name('pengaduan.detail');

    Route::resource('layanan', ServiceController::class)->except(['show']);
    Route::get('layanan/{layanan}/detail', [ServiceController::class, 'detail']);
    Route::resource('izin', ServicePermissionController::class)->only(['store', 'update', 'destroy']);
    Route::resource('berkas', ServicePermissionFormController::class)->only(['store', 'update', 'destroy']);

    Route::resource('agenda', AgendaController::class)->only(['store', 'update', 'destroy']);
    Route::get('agenda/all', [AgendaController::class, 'indexForUser'])->name('agenda.all');

    Route::resource('link-terkait', RelatedLinkController::class);
    Route::post('link-terkait/urutan', [RelatedLinkController::class, 'changeOrder'])->name('link-terkait.urutan');

    Route::get('skm/all', [SKMController::class, 'indexForUser'])->name('skm.all');
    Route::resource('skm', SKMController::class)->only(['store', 'update', 'destroy']);
    Route::resource('publikasi-nilai', PublicationController::class)->only(['store', 'update', 'destroy']);
    Route::resource('indikator', SKMIndicatorController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('skm-result', SKMResultController::class)->only(['store', 'update', 'destroy']);
    Route::resource('user', UserController::class)->except(['create', 'edit']);
    Route::patch('user/{user}/reset-password', [UserController::class, 'resetPassword'])->name('user.reset-password');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::patch('profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::patch('profile/password', [UserController::class, 'changePassword'])->name('profile.change-password');
});

Route::get('/', [IndexController::class, 'index']);
Route::get('agenda', [AgendaController::class, 'index'])->name('agenda.index');

Route::get('layanan/{layanan}', [ServiceController::class, 'show'])->name('layanan.show');

Route::get('pengaduan', [ComplaintController::class, 'index'])->name('pengaduan.index');
Route::get('pengaduan/{pengaduan}', [ComplaintController::class, 'show'])->name('pengaduan.show');
Route::post('pengaduan', [ComplaintController::class, 'store'])->name('pengaduan.store');

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::get('skm', [SKMController::class, 'index'])->name('skm.index');
Route::get('publikasi-nilai', [PublicationController::class, 'index'])->name('publikasi-nilai.index');
Route::get('galeri', [GalleryController::class, 'index'])->name('galeri.index');

Route::get('berita', [NewsController::class, 'index'])->name('berita.index');
Route::get('berita/{beritum}', [NewsController::class, 'show'])->name('berita.show');

Route::group(['prefix' => 'tentang'], function () {
    Route::get('profil', [AboutController::class, 'profil'])->name('about.profil');
    Route::get('visi-misi', [AboutController::class, 'visiMisi'])->name('about.visi-misi');
    Route::get('maklumat-pelayanan', [AboutController::class, 'maklumatPelayanan'])->name('about.maklumat-pelayanan');
    Route::get('struktur-organisasi', [AboutController::class, 'strukturOrganisasi'])->name('about.struktur-organisasi');
    Route::get('sop', [AboutController::class, 'sop'])->name('about.sop');
    Route::get('standar-pelayanan', [AboutController::class, 'standarPelayanan'])->name('about.standar-pelayanan');
});
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak.index');
