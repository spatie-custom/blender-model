<?php

namespace Spatie\Blender\Model\Updaters;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

trait UpdateDates
{
    protected function updateDates(Model $model, Request $request)
    {
        foreach ($model->getDates() as $dateAttribute) {
            if ($request->has($dateAttribute)) {
                $model->$dateAttribute = Carbon::createFromFormat('d/m/Y', $request->get($dateAttribute));
            }
        }
    }
}
