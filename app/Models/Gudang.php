<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'gudangs';
    protected $fillable = ['nama_gudang', 'contact_person', 'no_hp', 'alamat', 'provinsi', 'kota', 'status'];


   
}