<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
*
*/
class Student extends Model
{

  protected $fillable = ['id','name','address','phone','career'];

  protected $hidden = ['created_at','updated_at'];

	public static $rules = [
                      'name'    => 'required',
                      'phone'   => 'required|numeric',
                      'address' => 'required',
                      'career'  => 'required|in:engineering,math,physics'
										];

	public function courses()
	{
		return $this->belongsToMany('App\Course');
	}

}

?>
