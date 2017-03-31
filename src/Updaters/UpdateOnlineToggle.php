<?php

namespace Spatie\Blender\Model\Updaters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

trait UpdateOnlineToggle
{
    protected function updateOnlineToggle(Model $model, Request $request)
    {
        $model->online = $request->get('online') ?? false;
    }
}
