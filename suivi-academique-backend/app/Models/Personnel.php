<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use laravel\Sanctum\HasApiTokens;

/**
 * Class Personnel
 *
 * @property string $code_pers
 * @property string $nom_pers
 * @property string|null $prenom_pers
 * @property string $sexe_pers
 * @property string $phone_pers
 * @property string $login_pers
 * @property string $pwd_pers
 * @property string $type_pers
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Enseigne[] $enseignes
 * @property Collection|Programmation[] $programmations
 *
 * @package App\Models
 */
class Personnel extends Authenticatable
{
    use HasApiTokens;
	protected $table = 'personnel';
	protected $primaryKey = 'code_pers';
	public $incrementing = false;
    public $timestamps = true;

	protected $fillable = [
        'code_pers',
		'nom_pers',
		'prenom_pers',
		'sexe_pers',
		'phone_pers',
		'login_pers',
		'pwd_pers',
		'type_pers'
	];

	public function enseignes()
	{
		return $this->hasMany(Enseigne::class, 'code_pers');
	}

	public function programmations()
	{
		return $this->hasMany(Programmation::class, 'code_pers');
	}
}
