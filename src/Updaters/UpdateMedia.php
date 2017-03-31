<?php

namespace Spatie\Blender\Model\Updaters;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\Media;
use Illuminate\Database\Eloquent\Model;

trait UpdateMedia
{
    protected function updateMedia(Model $model, Request $request)
    {
        foreach ($model->mediaLibraryCollections() as $collection) {
            if (! $request->has($collection)) {
                continue;
            }

            $model->updateMedia(
                $this->convertKeysToSnakeCase(json_decode($request->get($collection), true)),
                $collection
            )->each(function (Media $media) {
                $media->setCustomProperty('draft', false);
                $media->save();
            });
        }
    }

    protected function convertKeysToSnakeCase(array $array): array
    {
        return collect($array)->map(function ($mediaProperties) {
            return collect($mediaProperties)->keyBy(function ($value, $key) {
                return snake_case($key);
            });
        })->toArray();
    }
}
