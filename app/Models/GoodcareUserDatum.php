<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodcareUserDatum
 * 
 * @property int $id
 * @property float|null $cost
 * @property int|null $currency
 * @property string|null $name
 * 
 * @property Collection|GoodcareUser[] $goodcare_users
 *
 * @package App\Models
 */
class GoodcareUserDatum extends Model
{
	protected $table = 'goodcare_user_data';
	public $timestamps = false;

	protected $casts = [
		'cost' => 'float',
		'currency' => 'int',
		'name' => 'string'
	];

	protected $fillable = [
		'cost',
		'currency',
		'name'
	];

	public function goodcare_users()
	{
		return $this->hasMany(GoodcareUser::class, 'user_data_id');
	}
}
