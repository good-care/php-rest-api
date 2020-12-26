<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodcareAccount
 * 
 * @property int $id
 * @property string $name
 * @property float|null $cost
 * @property int|null $currency
 * @property string $email
 * @property int|null $statustype
 * @property string $login
 * @property string $password
 * 
 * @property Collection|GoodcarePortfolio[] $goodcare_portfolios
 *
 * @package App\Models
 */
class GoodcareAccount extends Model
{
	protected $table = 'goodcare_accounts';
	public $timestamps = false;

	protected $casts = [
		'name' => 'string',
		'cost' => 'float',
		'currency' => 'int',
		'email' => 'string',
		'statustype' => 'int',
		'login' => 'string',
		'password' => 'string'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'cost',
		'currency',
		'email',
		'statustype',
		'login',
		'password'
	];

	public function goodcare_portfolios()
	{
		return $this->hasMany(GoodcarePortfolio::class, 'account_id');
	}
}
