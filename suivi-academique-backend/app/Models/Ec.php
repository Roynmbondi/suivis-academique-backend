<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ec
 *
 * @property string $code_ec
 * @property string $label_ec
 * @property string $desc_ec
 * @property int $nbh_ec
 * @property int $nbc_ec
 * @property string $code_ue
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Ue $ue
 * @property Collection|Enseigne[] $enseignes
 * @property Collection|Programmation[] $programmations
 *
 * @package App\Models
 */
class Ec extends Model
{
	protected $table = 'ec';
	protected $primaryKey = 'code_ec';
	public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

	protected $casts = [
		'nbh_ec' => 'int',
		'nbc_ec' => 'int'
	];

	protected $fillable = [
        'code_ec',
		'label_ec',
		'desc_ec',
		'nbh_ec',
		'nbc_ec',
		'code_ue'
	];

	public function ue()
	{
		return $this->belongsTo(Ue::class, 'code_ue');
	}

	public function enseignes()
	{
		return $this->hasMany(Enseigne::class, 'code_ec');
	}

	public function programmations()
	{
		return $this->hasMany(Programmation::class, 'code_ec');
	}
}
