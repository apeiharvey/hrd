<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model{
	protected $table = 'menu';

	public function parent(){
		return $this->belongsTo('App\Models\Menu','menu_id');
	}
	public function submenu(){
		return $this->hasMany('App\Models\Menu','menu_id');
	}
}