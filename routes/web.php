<?php
Route::get('/', 'CareerController@index');
Route::get('about-us','CareerController@aboutUs');
Route::get('blog','CareerController@news');
Route::get('blog/{category}','CareerController@newsCategory');
Route::get('blog/{category}/{id}','CareerController@newsDetail');
Route::get('employee-activity','CareerController@employeeActivity');
Route::get('contact-us','CareerController@contact');
Route::get('career','CareerController@career');
Route::get('career/apply','CareerController@apply');
Route::get('career/detailvacancy/{id}','AjaxController@showDetailVacancy');
Route::get('career/{category}','CareerController@careerCategory');
Route::get('career/{category}/{jobdetail}','CareerController@careerDetail');
Route::get('search','CareerController@searchCareer');
Route::get('send-email','AjaxController@sendEmail');

Route::get('about-us/ourcompanies/{id}','AjaxController@showOurCompanies');
Route::get('detailvacancy/{id}','AjaxController@showDetailVacancy');
Route::get('change-language/{id}','AjaxController@changeLanguage');
Route::post('apply-job','AjaxController@applyJob');

?>