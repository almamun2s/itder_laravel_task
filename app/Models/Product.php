<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the product's image URL.
     *
     * @return string
     */
    public function getImg()
    {
        $validator = Validator::make(['url' => $this->image], [
            'url' => 'url',
        ]);
        if ($validator->fails()) {

            if (($this->image != null) && (file_exists(PUBLIC_PATH . 'uploads/products/' . $this->image))) {
                return url('uploads/products/' . $this->image);
            }
            return url('admin/images/no_image.jpg');
        }
        return $this->image;
    }
}
