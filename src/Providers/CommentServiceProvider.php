<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Providers;
use NINA\Core\ServiceProvider;
use NINA\Helpers\Comment;

class CommentServiceProvider extends ServiceProvider
{
    protected $defer = true;
    public function register(): void
    {
        $this->app->singleton('comment', function () {
            return new Comment();
        });
    }
    public function provides(){
        return ['comment'];
    }
}