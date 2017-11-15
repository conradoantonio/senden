<?php

namespace App\Maps;

use JsonSerializable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

abstract class BaseMap implements Arrayable, Jsonable, JsonSerializable
{
    /**
     * The element(s) to Transform.
     *
     * @var mixed
     */
    public $elements;

    /**
     * Options for the Transformer.
     *
     * @var array
     */
    protected $options;

    /**
     * Initialize Transformer.
     *
     * @param  mixed  $elements
     * @param  array  $options
     */
    public function __construct(JsonSerializable $elements, $options = [])
    {
        $this->elements = $elements;
        $this->options = $options;
    }

    /**
     * Transform the provided model.
     *
     * @param  Model  $model
     * @return array
     */
    abstract public function transformModel(Model $model);

    /**
     * Transform an Eloquent Model or Collection.
     *
     * @param  Model|Collection  $elements
     * @param  array  $options
     * @return mixed
     */
    public function transform()
    {
        if ($this->elements instanceof Collection) {
            return $this->elements->map([$this, 'transformModel'])->toArray();
        } elseif ($this->elements instanceof LengthAwarePaginator) {
            return $this->elements->getCollection()->map([$this, 'transformModel'])->toArray();
        }

        return $this->transformModel($this->elements);
    }

    /**
     * Check if the model instance is loaded from the provided pivot table.
     *
     * @param  Model  $item
     * @param  string  $tableName
     * @return bool
     */
    protected function isLoadedFromPivotTable(Model $item, $tableName)
    {
        return $item->pivot && $item->pivot->getTable() == $tableName;
    }

    /**
     * Check if the provided relationship is loaded and is not null.
     *
     * @param  Model  $item
     * @param  string  $relationshipName
     * @return bool
     */
    protected function isRelationshipLoaded(Model $item, $relationshipName)
    {
        return $item->relationLoaded($relationshipName) && ! is_null($item->getRelation($relationshipName));
    }

    /**
     * Convert the Transformer instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->transform();
    }

    /**
     * Convert the Transformer instance to JSON.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
