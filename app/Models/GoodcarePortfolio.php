<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodcarePortfolio
 * 
 * @property int $id
 * @property string $name
 * @property float|null $cost
 * @property int|null $currency
 * @property int|null $account_id
 * 
 * @property GoodcareAccount|null $goodcare_account
 * @property Collection|GoodcareEvent[] $goodcare_events
 * @property Collection|GoodcarePortfoliosAsset[] $goodcare_portfolios_assets
 *
 * @package App\Models
 */
class GoodcarePortfolio extends Model
{
	protected $table = 'goodcare_portfolios';
	public $timestamps = false;

	protected $casts = [
		'name' => 'string',
		'cost' => 'float',
		'currency' => 'int',
		'account_id' => 'int'
	];

	protected $fillable = [
		'name',
		'cost',
		'currency',
		'account_id'
	];

	public function goodcare_account()
	{
		return $this->belongsTo(GoodcareAccount::class, 'account_id');
	}

	public function goodcare_events()
	{
		return $this->hasMany(GoodcareEvent::class, 'portfolio_id');
	}

	public function goodcare_portfolios_assets()
	{
		return $this->hasMany(GoodcarePortfoliosAsset::class, 'portfolio_id');
	}
}
