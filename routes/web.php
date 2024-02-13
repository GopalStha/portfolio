<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogSectionSettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactSectionSettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FeedbackSectionSettingController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PortfolioItemController;
use App\Http\Controllers\Admin\PortfolioSectionSetting;
use App\Http\Controllers\Admin\PortfolioSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillItemController;
use App\Http\Controllers\Admin\SkillSectionSettingController;
use App\Http\Controllers\Admin\TyperController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\FooterHelpLinkController;
use App\Http\Controllers\Admin\FooterInfoController;
use App\Http\Controllers\Admin\FooterSocialLinkController;
use App\Http\Controllers\Admin\FooterUsefulLinkController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\SeoSettingController;
use App\Http\Controllers\FooterContactInfoController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/blog', function () {
    return view('frontend.blog');
});

Route::get('/blog-details', function () {
    return view('frontend.blog-details');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('portfolio-details/{id}', [HomeController::class, 'showPortfolio'])->name('show.portfolio');
Route::get('blog-details/{id}', [HomeController::class, 'showBlog'])->name('show.blog');
Route::get('blog', [HomeController::class, 'blog'])->name('blog');
Route::post('contact', [HomeController::class, 'contact'])->name('contact');

/* Admin Routes */
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('hero', HeroController::class);
    Route::resource('typer-title', TyperController::class);

    /* Service Routes */
    Route::resource('service', ServiceController::class);

    /* About Routes */
    Route::get('resume/download', [AboutController::class, 'resumeDownload'])->name('resume.download');
    Route::resource('about', AboutController::class);

    /* Portfolio Category Routes */
    Route::resource('category', CategoryController::class);

    /* Portfolio Item Routes */
    Route::resource('portfolio-item', PortfolioItemController::class);

    /* Portfolio Section Setting Routes */
    Route::resource('portfolio-section-setting', PortfolioSettingController::class);

    /* Skill Section Setting Routes */
    Route::resource('skill-section-setting', SkillSectionSettingController::class);

    /* Skill Item Routes */
    Route::resource('skill-item', SkillItemController::class);

    /* Experience Routes */
    Route::resource('experience', ExperienceController::class);

    /* Feedback Section Routes */
    Route::resource('feedback', FeedbackController::class);

    /* Feedback Section Setting Routes */
    Route::resource('feedback-section-setting', FeedbackSectionSettingController::class);

    /* Blog Catrgory Routes */
    Route::resource('blog-category', BlogCategoryController::class);

    /* Blog Routes */
    Route::resource('blog', BlogController::class);

    /* Blog Section Setting Routes */
    Route::resource('blog-section-setting', BlogSectionSettingController::class);

    /* Footer Section Setting Routes */
    Route::resource('contact-section-setting', ContactSectionSettingController::class);

    /* Footer Social Link Routes */
    Route::resource('footer-social', FooterSocialLinkController::class);


    /* Footer Info Routes */
    Route::resource('footer-info', FooterInfoController::class);

    /* Footer Contact Info Routes */
    Route::resource('footer-contact-info', FooterContactInfoController::class);

    /* Footer Useful Links Routes */
    Route::resource('footer-useful-links', FooterUsefulLinkController::class);

    /* Footer Help Links Routes */
    Route::resource('footer-help-links', FooterHelpLinkController::class);

    /* Setting Routes */
    Route::get('setting', SettingController::class)->name('settings.index');

    /* General Setting Routes */
    Route::resource('general-setting', GeneralSettingController::class);

    /* SEO Setting Routes */
    Route::resource('seo-setting', SeoSettingController::class);
});
