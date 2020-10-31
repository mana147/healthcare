<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Devices extends Model
{
	use Notifiable;

    protected $table = 'devices';

    protected $guarded = [];

   	public $timestamps = false;
}
