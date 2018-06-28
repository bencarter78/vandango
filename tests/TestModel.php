<?php

namespace Tests;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class TestModel extends TestCase
{
    protected $fillable = [];

    protected $dates = [];

    protected $relationships = [];

    protected $relationshipTypes = [
        'belongsTo' => BelongsTo::class,
        'belongsToMany' => BelongsToMany::class,
        'hasOne' => HasOne::class,
        'hasMany' => HasMany::class,
        'hasManyThrough' => HasManyThrough::class,
        'morphTo' => MorphTo::class,
        'morphMany' => MorphMany::class,
        'morphToMany' => MorphToMany::class,
        'morphOne' => MorphOne::class,
        'morphedByMany' => MorphToMany::class,
    ];

    function model($model = null)
    {
        return $model ? new $model : new $this->model;
    }

    /** @test */
    function assertAttributesAreFillable()
    {
        foreach ($this->fillable as $attribute) {
            $this->assertTrue(in_array($attribute, $this->model()->getFillable()));
        }
    }

    /** @test */
    function assertAttributesAreDates()
    {
        foreach ($this->dates as $date) {
            $this->assertTrue(in_array($date, $this->model()->getDates()));
        }
    }

    /** @test */
    public function assertRelationships()
    {
        foreach ($this->relationships as $method => $value) {
            $relationship = $this->model()->{$method}();
            $type = key($value);
            $class = $value[key($value)];
            $this->assertEquals(get_class($relationship), $this->relationshipTypes[$type]);
            $this->assertEquals(get_class($relationship->getRelated()), $class);
        }
    }
}
