<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodcareIssuer
 * 
 * @property int $id
 * @property string|null $name
 * 
 * @property Collection|GoodcareAsset[] $goodcare_assets
 *
 * @package App\Models
 */
class GoodcareIssuer extends Model
{
	protected $table = 'goodcare_issuers';
	public $timestamps = false;

	protected $casts = [
		'name' => 'string'
	];

	protected $fillable = [
		'name'
	];

	public function goodcare_assets()
	{
		return $this->hasMany(GoodcareAsset::class, 'issuer_id');
	}
}
