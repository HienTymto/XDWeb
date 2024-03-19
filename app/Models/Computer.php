<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Computer
 * 
 * @property int $ComputerID
 * @property int|null $LabID
 * @property string $Name
 * @property string $OperatingSystem
 * @property string $Specifications
 * @property string $Status
 *
 * @package App\Models
 */
class Computer extends Model
{
	protected $table = 'computers';
	protected $primaryKey = 'ComputerID';
	public $timestamps = false;

	protected $casts = [
		'LabID' => 'int'
	];

	protected $fillable = [
		'LabID',
		'Name',
		'OperatingSystem',
		'Specifications',
		'Status'
	];
}
