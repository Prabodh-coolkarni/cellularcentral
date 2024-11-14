<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    const Mobile='Mobile';
    const accessories='accessories';
    const tab='tab';
    const smart_watch='Smart watch';

    Const category=[
        self::Mobile=>'Mobile',
        self::accessories=>'accessories',
        self::tab=>'tab',
        self::smart_watch=>'Smart watch',
    ];
    use HasFactory;
    protected $table="products";
    protected $fillable = [
        'category',
            'name',
            'description',
            'Brand',
            'Model',
            'Version',
            'Processor',
            'RAM',
            'ROM',
            'Color',
            'Display_Size',
            'Camera_f',
            'Camera_b',
            'Battery',
            'Gallery',
            'Price',
    ];
    public function setGalleryAttribute($value)
{
    $this->attributes['Gallery'] = is_array($value) ? json_encode($value):$value;
}
   
}
