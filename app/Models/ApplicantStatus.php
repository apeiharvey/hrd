<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantStatus extends Model{
	protected $table = 'applicant_status';
	protected $applicant = 'App\Models\Applicant';
	protected $vacancy = 'App\Models\VacancyPost';

	public function total_applicant(){
		return $this->hasMany($this->applicant,'status_id');
	}
}