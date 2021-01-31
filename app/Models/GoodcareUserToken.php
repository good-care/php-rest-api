<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodcareUserToken
 * 
 * @property int $id
 * @property string|null $token
 * 
 * @property Collection|GoodcareUser[] $goodcare_users
 *
 * @package App\Models
 */
class GoodcareUserToken extends Model
{
	protected $table = 'goodcare_user_tokens';
	public $timestamps = false;

	protected $casts = [
		'token' => 'string'
	];

	protected $hidden = [
//		'token'
	];

	protected $fillable = [
		'token'
	];

	public function goodcare_users()
	{
		return $this->hasMany(GoodcareUser::class, 'token_id');
	}
}
