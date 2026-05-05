<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\AuditLog;
use App\Models\Faq;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->registerAuditObservers();
    }

    private function registerAuditObservers(): void
    {
        $log = function (Model $model, string $action) {
            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => $action,
                'model' => $model::class,
                'model_id' => $model->getKey(),
                'changes' => $model->wasRecentlyCreated ? $model->getAttributes() : $model->getChanges(),
                'ip' => request()->ip(),
                'created_at' => now(),
            ]);
        };

        foreach ([Page::class, Announcement::class, Faq::class] as $cls) {
            $cls::saved(function (Model $m) use ($cls, $log) {
                $log($m, $m->wasRecentlyCreated ? 'created' : 'updated');
                Cache::forget('cms:'.class_basename($cls).':'.$m->getKey());
            });
            $cls::deleted(fn (Model $m) => $log($m, 'deleted'));
        }
    }
}
