<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Programmation
 *
 * @property string $code_ec
 * @property string $num_salle
 * @property string $code_pers
 * @property Carbon $date
 * @property Carbon $date-debut
 * @property Carbon $date_fin
 * @property int $nbre_heure
 * @property string $statut
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Ec $ec
 * @property Personnel $personnel
 * @property Salle $salle
 *
 * @package App\Models
 */
class Programmation extends Model
{
	protected $table = 'programmation';
	public $incrementing = false;
    public $timestamps = true;

	protected $casts = [
		'date' => 'datetime',
		'date-debut' => 'datetime',
		'date_fin' => 'datetime',
		'nbre_heure' => 'int'
	];

	protected $fillable = [
		'date',
		'date-debut',
		'date_fin',
		'nbre_heure',
		'statut',
        'code_ec',
        'num_salle',
        'code_pers'
	];

	public function ec()
	{
		return $this->belongsTo(Ec::class, 'code_ec');
	}

	public function personnel()
	{
		return $this->belongsTo(Personnel::class, 'code_pers');
	}

	public function salle()
	{
		return $this->belongsTo(Salle::class, 'num_salle');
	}
}
