<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
	use Notifiable;

    protected $table = 'member';

    protected $guarded = [];

   	public $timestamps = false;
}
