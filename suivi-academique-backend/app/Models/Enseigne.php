<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Enseigne
 *
 * @property string $code_pers
 * @property string $code_ec
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Ec $ec
 * @property Personnel $personnel
 *
 * @package App\Models
 */
class Enseigne extends Model
{
	protected $table = 'enseigne';
	public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        "code_ec",
        "code_pers"
    ];

	public function ec()
	{
		return $this->belongsTo(Ec::class, 'code_ec');
	}

	public function personnel()
	{
		return $this->belongsTo(Personnel::class, 'code_pers');
	}
}
