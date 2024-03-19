<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * 
 * @property int $HistoryID
 * @property string $HistoryDes
 * @property Carbon|null $RepairDay
 * @property float|null $RepairCost
 * @property int|null $ComputerID
 *
 * @package App\Models
 */
class History extends Model
{
	protected $table = 'history';
	protected $primaryKey = 'HistoryID';
	public $timestamps = false;

	protected $casts = [
		'RepairDay' => 'datetime',
		'RepairCost' => 'float',
		'ComputerID' => 'int'
	];

	protected $fillable = [
		'HistoryDes',
		'RepairDay',
		'RepairCost',
		'ComputerID'
	];
}
