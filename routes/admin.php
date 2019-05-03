<?php

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

Route::get('/', 'HomeController@index');
Route::get('/dailymail', 'MailAdminController@index');
Route::get('/applicants', 'ApplicantController@index');
Route::get('/applicants/mail', 'ApplicantController@doUpdate');
Route::get('/applicants/detail/{id}-{status}', 'ApplicantController@show');
Route::post('/applicants/mailTo','MailController@index');
Route::post('/privilege/active','AdminController@active');
Route::get('/applicants/{category}','ApplicantController@category');
Route::get('/chart', 'HomeController@index');
Route::get('/applicants/status-applicant/{id}', 'ApplicantController@filter');
Route::get('/status/{timeOption}','HomeController@chart');
Route::get('/applicants/template/{template}','ApplicantController@template1');
Route::get('/applicants/{category}/template/{template}','ApplicantController@template');
Route::get('/applicants/subject/{template}','ApplicantController@template1');
Route::get('/applicants/{category}/subject/{template}','ApplicantController@template');
Route::get('/sign-in', 'SigninController@index');
Route::get('/sign-out', 'SignoutController@index');
Route::post('/home', 'SigninController@sign');
Route::get('/applicant-status/{id}', 'ApplicantController@filter');
Route::get('/settings', 'SettingsController@index');
Route::post('/settings/addSettings','SettingsController@addSettings');
Route::get('/contents', 'ContentsController@index');
Route::post('/contents/addContents','ContentsController@addContents');

Route::resource('/privilege', 'AdminController');
Route::resource('/users', 'UsersController');
Route::resource('/manage-account','ManageAccountController');
Route::get('/social-media/sorting', 'SocialMediaController@sorting');
Route::post('/social-media/doSorting', 'SocialMediaController@doSorting');
Route::resource('/social-media', 'SocialMediaController');
Route::get('/company-value/sorting', 'CompanyValueController@sorting');
Route::post('/company-value/doSorting', 'CompanyValueController@doSorting');
Route::resource('/company-value', 'CompanyValueController');
Route::resource('/gallery', 'GalleryController');
Route::get('/vacancy-category/sorting', 'VacancyCategoryController@sorting');
Route::post('/vacancy-category/doSorting', 'VacancyCategoryController@doSorting');
Route::resource('/vacancy-category', 'VacancyCategoryController');
Route::get('/vacancy-post/sorting', 'VacancyPostController@sorting');
Route::post('/vacancy-post/doSorting', 'VacancyPostController@doSorting');
Route::resource('/vacancy-post', 'VacancyPostController');
Route::get('/company-category/sorting', 'CompanyCategoryController@sorting');
Route::post('/company-category/doSorting', 'CompanyCategoryController@doSorting');
Route::resource('/company-category', 'CompanyCategoryController');
Route::get('/company-post/sorting', 'CompanyPostController@sorting');
Route::post('/company-post/doSorting', 'CompanyPostController@doSorting');
Route::resource('/company-post', 'CompanyPostController');
Route::get('/blog-category/sorting', 'BlogCategoryController@sorting');
Route::post('/blog-category/doSorting', 'BlogCategoryController@doSorting');
Route::resource('/blog-category', 'BlogCategoryController');
Route::resource('/blog-post', 'BlogPostController');
Route::resource('/email-template', 'EmailTemplateController');
Route::get('/testimonial/sorting', 'TestimonialController@sorting');
Route::post('/testimonial/doSorting', 'TestimonialController@doSorting');
Route::resource('/testimonial', 'TestimonialController');
Route::resource('/applicants', 'ApplicantController');