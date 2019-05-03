<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyPost extends Model{
	protected $table = 'vacancy_post';

	protected $applicant		= 'App\Models\Applicant';

	public function total_applicant(){
		return $this->hasMany($this->applicant,'id_vacancy_post');
	}
}