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

class SlugModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'slug';
    public function getStatus($model) {
	    return $this->belongsTo($model,'id_parent','id')
            ->select('id')
            ->whereRaw("FIND_IN_SET(?, status)", ['hienthi']);
	}
}
