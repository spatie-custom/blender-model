<?php

namespace Spatie\Blender\Model\Updaters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

trait UpdateTranslations
{
    protected function updateTranslations(Model $model, Request $request)
    {
        foreach (config('app.locales') as $locale) {
            foreach ($model->getTranslatableAttributes() as $fieldName) {
                $translatedFieldName = translate_field_name($fieldName, $locale);

                if (! $request->exists($translatedFieldName)) {
                    continue;
                }

                $model->setTranslation($fieldName, $locale, $request->get($translatedFieldName));
            }
        }
    }
}
