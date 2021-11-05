<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kepolisianModel extends Model
{
	protected $table = 'kepolisian';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'kepolisian', 'alamat','city_name', 'email',
	];
}