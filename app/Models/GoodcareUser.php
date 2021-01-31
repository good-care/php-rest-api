<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class GoodcareUser
 * 
 * @property int $id
 * @property string|null $email
 * @property string|null $login
 * @property string|null $password
 * @property datetime|null $registered
 * @property int|null $status
 * @property int|null $token_id
 * @property int|null $user_data_id
 * 
 * @property GoodcareUserToken|null $goodcare_user_token
 * @property GoodcareUserDatum|null $goodcare_user_datum
 * @property Collection|GoodcarePortfolio[] $goodcare_portfolios
 *
 * @package App\Models
 */
class GoodcareUser extends Model
{
	protected $table = 'goodcare_users';
	public $timestamps = false;

	protected $casts = [
		'email' => 'string',
		'login' => 'string',
		'password' => 'string',
		'registered' => 'datetime',
		'status' => 'int',
		'token_id' => 'int',
		'user_data_id' => 'int'
	];

	protected $hidden = [
//		'password'
	];

	protected $fillable = [
		'email',
		'login',
		'password',
		'registered',
		'status',
		'token_id',
		'user_data_id'
	];

	public function goodcare_user_token(): BelongsTo
    {
		return $this->belongsTo(GoodcareUserToken::class, 'token_id');
	}

	public function goodcare_user_datum(): BelongsTo
    {
		return $this->belongsTo(GoodcareUserDatum::class, 'user_data_id');
	}

	public function goodcare_portfolios()
	{
		return $this->hasMany(GoodcarePortfolio::class, 'user_id');
	}
}
