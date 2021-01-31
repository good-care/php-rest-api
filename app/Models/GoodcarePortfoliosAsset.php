<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodcarePortfoliosAsset
 * 
 * @property int $id
 * @property string|null $name
 * @property float|null $cost
 * @property float|null $number
 * @property float|null $quotation
 * @property int|null $moex_asset_id
 * @property int|null $portfolio_id
 * 
 * @property GoodcareAsset|null $goodcare_asset
 * @property GoodcarePortfolio|null $goodcare_portfolio
 *
 * @package App\Models
 */
class GoodcarePortfoliosAsset extends Model
{
	protected $table = 'goodcare_portfolios_assets';
	public $timestamps = false;

	protected $casts = [
		'name' => 'string',
		'cost' => 'float',
		'number' => 'float',
		'quotation' => 'float',
		'moex_asset_id' => 'int',
		'portfolio_id' => 'int'
	];

	protected $fillable = [
		'name',
		'cost',
		'number',
		'quotation',
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
