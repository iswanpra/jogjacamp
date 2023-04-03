<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * *************************
 *
 * @Column name id_kegiatan
 * @Column name kemen_id
 * @Column name nama
 * @Column name created_at
 * @Column name updated_at
 *
 * *************************
*/

class category extends Model
{
	use HasFactory;

	/*
	* *********************************
	*
	* Model Resource for table kegiatan
	*
	* @Contact Email didaputraa@gmail.com
	*
	* @Author By Dida Putra Aditiya
	*
	* *********************************
	*/

	protected $table		= 'category';
	protected $fillable = ['id', 'name', 'is_publish', 'created_at', 'updated_at'];
	protected $primaryKey= 'id';


	/*
	 * ***********************************
	 *
	 * @Relationship for Belong Kementrian
	 *
	 * ***********************************
	*/



}