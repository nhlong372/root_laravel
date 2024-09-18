<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Models;

use NINA\Database\Eloquent\Factories\HasFactory;
use NINA\Database\Eloquent\Model;
use NINA\Traits\TraitAttr;

class ProductCatModel extends Model
{
    use HasFactory,TraitAttr;
    protected $guarded = [];
    protected $table = 'product_cat';
    public function getItems($select = ['*'])
    {
        return $this->hasMany(ProductModel::class,'id_cat')
            ->select($select)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'desc')
            ->orderBy('id', 'desc');
    }
    public function getCategoryList(): \NINA\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductListModel::class,'id_list','id');
    }
    public function getCategoryItems(): \NINA\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ProductItemModel::class,'id_cat');
    }
    public function getCategorySubs(): \NINA\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ProductSubModel::class,'id_cat');
    }
}