<?php
    namespace App\Item;
    use Illuminate\Database\Eloquent\Model;
    class Item extends Model
    {
    public $fillable = ['title','description'];
    }
