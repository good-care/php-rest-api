<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodcareExchangeRatesUsd
 * 
 * @property int $id
 * @property float|null $eur
 * @property float|null $rub
 * @property timestamp without time zone|null $date_time
 *
 * @package App\Models
 */
class GoodcareExchangeRatesUsd extends Model
{
	protected $table = 'goodcare_exchange_rates_usd';
	public $timestamps = false;

	protected $casts = [
		'eur' => 'float',
		'rub' => 'float',
		'date_time' => 'timestamp without time zone'
	];

	protected $fillable = [
		'eur',
		'rub',
		'date_time'
	];
}
