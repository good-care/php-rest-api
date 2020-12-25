<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodcareEvent
 * 
 * @property int $id
 * @property float|null $cost
 * @property timestamp without time zone|null $date_time
 * @property int|null $eventtype
 * @property float|null $number
 * @property int|null $moex_asset_id
 * @property int|null $portfolio_id
 * 
 * @property GoodcareAsset|null $goodcare_asset
 * @property GoodcarePortfolio|null $goodcare_portfolio
 *
 * @package App\Models
 */
class GoodcareEvent extends Model
{
	protected $table = 'goodcare_events';
	public $timestamps = false;

	protected $casts = [
		'cost' => 'float',
		'date_time' => 'timestamp without time zone',
		'eventtype' => 'int',
		'number' => 'float',
		'moex_asset_id' => 'int',
		'portfolio_id' => 'int'
	];

	protected $fillable = [
		'cost',
		'date_time',
		'eventtype',
		'number',
		'moex_asset_id',
		'portfolio_id'
	];

	public function goodcare_asset()
	{
		return $this->belongsTo(GoodcareAsset::class, 'moex_asset_id');
	}

	public function goodcare_portfolio()
	{
		return $this->belongsTo(GoodcarePortfolio::class, 'portfolio_id');
	}
}
