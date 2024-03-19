<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Roomallocation
 * 
 * @property int $AllocationID
 * @property string|null $ProfessorName
 * @property int|null $LabID
 * @property Carbon $Date
 * @property Carbon $StartTime
 * @property Carbon $EndTime
 *
 * @package App\Models
 */
class Roomallocation extends Model
{
	protected $table = 'roomallocation';
	protected $primaryKey = 'AllocationID';
	public $timestamps = false;

	protected $casts = [
		'LabID' => 'int',
		'Date' => 'datetime',
		'StartTime' => 'datetime',
		'EndTime' => 'datetime'
	];

	protected $fillable = [
		'ProfessorName',
		'LabID',
		'Date',
		'StartTime',
		'EndTime'
	];
}
