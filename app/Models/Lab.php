<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lab
 * 
 * @property int $LabID
 * @property string $Name
 * @property string $Location
 *
 * @package App\Models
 */
class Lab extends Model
{
	protected $table = 'labs';
	protected $primaryKey = 'LabID';
	public $timestamps = false;

	protected $fillable = [
		'Name',
		'Location'
	];
}
