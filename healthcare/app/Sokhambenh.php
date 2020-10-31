<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sokhambenh extends Model
{
	use Notifiable;

    protected $table = 'sokhambenh';

    protected $guarded = [];

   	// protected $fillable = ['id','id_userhw','chuan_doan','nhip_tim','oxy','huyet_ap','nhiet_do','chieu_cao','can_nang','tuoi','gioi_tinh','id_donthuoc'];

    public $timestamps = false;


}
