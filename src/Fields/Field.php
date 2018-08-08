<?php

namespace AdamJedlicka\Admin\Fields;

use JsonSerializable;
use Illuminate\Support\Str;

abstract class Field implements JsonSerializable
{
    /**
     * Display name of the field
     *
     * @var string
     */
    protected $displayName;

    /**
     * Name of the field in the database
     *
     * @var string
     */
    protected $field;

    /**
     * Is this field visible on the index view?
     *
     * @var boolean
     */
    protected $visibleIndex = false;

    /**
     * Is this field visible on the detail view?
     *
     * @param boolean
     */
    protected $visibleDetail = true;

    private function __construct(string $displayName, ? string $field = null)
    {
        $this->name = $displayName;
        $this->field = $field ?? Str::snake($this->name);
    }

    /**
     * Named constructor for fluent syntax
     *
     * @param string $displayName Display name of the field
     * @param string|null $field Name fo the field in database
     */
    public static function make(string $displayName, ? string $field = null)
    {
        $self = new static($displayName, $field);
        return $self;
    }

    /**
     * Show field on index view
     *
     * @return \AdamJedlicka\Admin\Fields\Field
     */
    public function showOnIndex()
    {
        $this->visibleIndex = true;
        return $this;
    }

    /**
     * Show field on detail view
     *
     * @return \AdamJedlicka\Admin\Fields\Field
     */
    public function showOnDetail()
    {
        $this->visibleDetail = true;
        return $this;
    }

    /**
     * Hide field from index view
     *
     * @return \AdamJedlicka\Admin\Fields\Field
     */
    public function hideFromIndex()
    {
        $this->visibleIndex = false;
        return $this;
    }

    /**
     * Hide field from detail view
     *
     * @return \AdamJedlicka\Admin\Fields\Field
     */
    public function hideFromDetail()
    {
        $this->visibleDetail = false;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'type' => (new \ReflectionClass($this))->getShortName(),
            'name' => $this->name,
            'field' => $this->field,
            'visibleIndex' => $this->visibleIndex,
            'visibleDetail' => $this->visibleDetail,
        ];
    }
}