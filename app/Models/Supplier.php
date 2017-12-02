<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $fillable = ['nama', 'ktkPerson', 'no_hp', 'alamat', 'provinsi', 'kabupaten', 'tipe', 'status'];

    public function brand() {
    	return $this->belongsTo('Brand');
    }

    

}