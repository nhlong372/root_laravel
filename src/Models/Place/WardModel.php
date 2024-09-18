<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Models\Place;
use NINA\Database\Eloquent\Factories\HasFactory;
use NINA\Database\Eloquent\Model;

class WardModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'ward';
    public function getCity(): \NINA\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('NINA\Models\Place\CityModel', 'id_city');
    }
    public function getDistrict(): \NINA\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('NINA\Models\Place\CityModel', 'id_district');
    }
}