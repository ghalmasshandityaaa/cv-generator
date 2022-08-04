<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TrainingsController;
use App\Http\Controllers\ResumeController;

Route::middleware(['auth'])->group(function () {
    Route::get('/preview', [ProfileController::class, 'show'])->name('profile-preview');
    Route::get('/export', [ProfileController::class, 'export'])->name('profile-export');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile-update');

    Route::get('/education', [EducationController::class, 'index'])->name('education');
    Route::post('/education/add', [EducationController::class, 'store'])->name('education-add');
    Route::post('/education/edit/{id}', [EducationController::class, 'update'])->name('education-edit');
    Route::post('/education/delete/{id}', [EducationController::class, 'destroy'])->name('education-delete');


    Route::get('/experience', [ExperienceController::class, 'index'])->name('experience');
    Route::post('/experience/add', [ExperienceController::class, 'store'])->name('experience-add');
    Route::post('/experience/edit/{id}', [ExperienceController::class, 'update'])->name('experience-edit');
    Route::post('/experience/delete/{id}', [ExperienceController::class, 'destroy'])->name('experience-delete');


    Route::get('/skills', [SkillsController::class, 'index'])->name('skills');
    Route::post('/skills/add', [SkillsController::class, 'store'])->name('skills-add');
    Route::post('/skills/edit/{id}', [SkillsController::class, 'update'])->name('skills-edit');
    Route::post('/skills/delete/{id}', [SkillsController::class, 'destroy'])->name('skills-delete');


    Route::get('/language', [LanguageController::class, 'index'])->name('language');
    Route::post('/language/add', [LanguageController::class, 'store'])->name('language-add');
    Route::post('/language/edit/{id}', [LanguageController::class, 'update'])->name('language-edit');
    Route::post('/language/delete/{id}', [LanguageController::class, 'destroy'])->name('language-delete');


    Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
    Route::post('/activity/add', [ActivityController::class, 'store'])->name('activity-add');
    Route::post('/activity/edit/{id}', [ActivityController::class, 'update'])->name('activity-edit');
    Route::post('/activity/delete/{id}', [ActivityController::class, 'destroy'])->name('activity-delete');


    Route::get('/trainings', [TrainingsController::class, 'index'])->name('trainings');
    Route::post('/trainings/add', [TrainingsController::class, 'store'])->name('trainings-add');
    Route::post('/trainings/edit/{id}', [TrainingsController::class, 'update'])->name('trainings-edit');
    Route::post('/trainings/delete/{id}', [TrainingsController::class, 'destroy'])->name('trainings-delete');


    Route::get('/resume', [ResumeController::class, 'index'])->name('resume');
    Route::post('/resume/add', [ResumeController::class, 'store'])->name('resume-add');
    Route::post('/resume/edit/{id}', [ResumeController::class, 'update'])->name('resume-edit');
    Route::post('/resume/delete/{id}', [ResumeController::class, 'destroy'])->name('resume-delete');
});
require __DIR__ . '/auth.php';
