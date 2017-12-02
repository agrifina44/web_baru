<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
	protected $table ='products';
	protected $fillable = ['sku','kategori', 'brand', 'style', 'gudang', 'size', 'gender', 'supplier', 'stock', 'status', 'foto'];
}