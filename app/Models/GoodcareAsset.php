<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodcareAsset
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $assettype
 * @property int|null $currency
 * @property bool|null $is_trade
 * @property string|null $security_id
 * @property int|null $issuer_id
 * 
 * @property GoodcareIssuer|null $goodcare_issuer
 * @property Collection|GoodcareAssetsQuotation[] $goodcare_assets_quotations
 * @property Collection|GoodcareEvent[] $goodcare_events
 * @property Collection|GoodcarePortfoliosAsset[] $goodcare_portfolios_assets
 *
 * @package App\Models
 */
class GoodcareAsset extends Model
{
	protected $table = 'goodcare_assets';
	public $timestamps = false;

	protected $casts = [
		'name' => 'string',
		'assettype' => 'int',
		'currency' => 'int',
		'is_trade' => 'bool',
		'security_id' => 'string',
		'issuer_id' => 'int'
	];

	protected $fillable = [
		'name',
		'assettype',
		'currency',
		'is_trade',
		'security_id',
		'issuer_id'
	];

	public function goodcare_issuer()
	{
		return $this->belongsTo(GoodcareIssuer::class, 'issuer_id');
	}

	public function goodcare_assets_quotations()
	{
		return $this->hasMany(GoodcareAssetsQuotation::class, 'moex_asset_id');
	}

	public function goodcare_events()
	{
		return $this->hasMany(GoodcareEvent::class, 'moex_asset_id');
	}

	public function goodcare_portfolios_assets()
	{
		return $this->hasMany(GoodcarePortfoliosAsset::class, 'moex_asset_id');
	}
}
