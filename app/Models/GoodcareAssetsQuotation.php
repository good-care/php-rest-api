<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodcareAssetsQuotation
 * 
 * @property int $id
 * @property timestamp without time zone|null $date_time
 * @property float|null $quotation
 * @property int|null $quotationtype
 * @property int|null $moex_asset_id
 * 
 * @property GoodcareAsset|null $goodcare_asset
 *
 * @package App\Models
 */
class GoodcareAssetsQuotation extends Model
{
	protected $table = 'goodcare_assets_quotations';
	public $timestamps = false;

	protected $casts = [
		'date_time' => 'timestamp without time zone',
		'quotation' => 'float',
		'quotationtype' => 'int',
		'moex_asset_id' => 'int'
	];

	protected $fillable = [
		'date_time',
		'quotation',
		'quotationtype',
		'moex_asset_id'
	];

	public function goodcare_asset()
	{
		return $this->belongsTo(GoodcareAsset::class, 'moex_asset_id');
	}
}
