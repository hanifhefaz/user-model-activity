<?php

namespace Hanifhefaz\UserModelActivity\Traits;

use Illuminate\Support\Facades\Log;

trait UserModelActivityLogger
{
    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($model) {
            $model->logActivity('created');
        });

        static::updated(function ($model) {
            $model->logActivity('updated');
        });

        static::deleted(function ($model) {
            $model->logActivity('deleted');
        });
    }


    protected function logActivity($activityType)
    {

        $logChannel = 'user-model-activity';

        Log::channel($logChannel)->info(get_class($this) . " " . $activityType . ": " . $this->toJson());

    }
}
