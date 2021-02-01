<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable =[
        'sub_category_id',
        'url',
         'name',
         'url',
          'small_description',
           'image',
           'highlight_heading',
            'p_highlights',
             'description_heading',
              'p_description',
              'details_heading',
               'p_details',
                'sale_tag',
                 'original_price',
                  'offer_price',
                   'quantity',
                   'priority',
                    'new_arrival',
                     'featured_products',
                      'popular_products',
                       'offer_products',
                        'status',
                         'meta_title',
                         'meta_description',
                          'meta_keyword'
    ];

    public function subCategory(){
        return $this->BelongsTo(Subcategory::class,'sub_category_id','id');
    }
}
