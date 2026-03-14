<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Salle
 *
 * @property string $num_salle
 * @property int $contenance
 * @property string $statut
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Programmation[] $programmations
 *
 * @package App\Models
 */
class Salle extends Model
{
	protected $table = 'salle';
	protected $primaryKey = 'num_salle';
	public $incrementing = false;
    public $timestamps = true;

	protected $casts = [
		'contenance' => 'int'
	];

	protected $fillable = [
        'num_salle',
		'contenance',
		'statut'
	];

	public function programmations()
	{
		return $this->hasMany(Programmation::class, 'num_salle');
	}
}
