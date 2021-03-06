<?php

namespace AdamJedlicka\Luna\Fields;

use AdamJedlicka\Luna\Resource;
use Illuminate\Database\Eloquent\Model;
use AdamJedlicka\Luna\Facades\Resources;

class PivotBelongsTo extends BelongsTo
{
    protected $isPivot = true;

    public function retrieve(Model $model)
    {
        return $model->{$model->getRelatedKey()};
    }

    public function meta(Resource $resource, Model $model)
    {
        $relatedResource = Resources::forModel($model);

        return [
            'title' => $relatedResource->title(),
        ];
    }

    public function getType() : string
    {
        return 'BelongsTo';
    }

    public function getForeignKeyName() : string
    {
        return $this->relationship->getRelatedPivotKeyName();
    }
}
