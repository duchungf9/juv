<?php

namespace App\FromSky\Admin\Helpers;


/*
|--------------------------------------------------------------------------
|  Duplicate content with
|  $cloneable_relations
|  $clone_exempt_attributes
|  refer to news model for
|  examples
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Arr;

/**
 * Trait ModelReplicatorTrait
 * @package App\FromSky\Admin\Helpers
 */
trait ModelReplicatorTrait
{


    public array $uniqueFields;
    protected $model;

    /**
     * Create duplicate of the model
     * @param $model_id
     * @return mixed
     */
    public function duplicateModel($model_id)
    {

        $this->model        = $this->modelClass::find($model_id);
        $this->uniqueFields = $this->getCloneExemptAttributes($this->model);
        $clone              = $this->model->replicate($this->uniqueFields);
        $clone->save();
        $this->cloneRelations($clone);
        return $clone;
    }


    /**
     *  duplicate the cloneable relations
     * @param $clone
     */
    protected function cloneRelations($clone)
    {
        $cloneable_relations = collect($this->model->cloneable_relations);
        if ($cloneable_relations->isEmpty()) return;
        $this->uniqueFields = $this->getCloneExemptAttributes($this->model);
        foreach ($cloneable_relations as $relation_name) {

            if ($this->model->$relation_name) {
                $relation = call_user_func([$this->model, $relation_name]);
                if (is_a($relation, 'Illuminate\Database\Eloquent\Relations\BelongsToMany')) {
                    $this->duplicatePivotedRelation($relation, $relation_name, $clone);
                } else {
                    $this->duplicateDirectRelation($relation, $relation_name, $clone);
                }
            }
        }
    }


    protected function getCloneExemptAttributes($model)
    {

        // Always make the id and timestamps exempt
        $defaults = [
            $model->getKeyName(),
            $model->getCreatedAtColumn(),
            $model->getUpdatedAtColumn(),
        ];

        // If none specified, just return the defaults, else, merge them
        if (!isset($model->clone_exempt_attributes)) return $defaults;
        return array_filter(array_merge($defaults, $model->clone_exempt_attributes));

    }

    /** resolve relation primary key
     * @param $relation
     * @return array|mixed
     */
    protected function resolvePrimaryKey($relation)
    {
        return data_get($this->model->clone_foreigns_keys, $relation, $this->model->getForeignKey());
    }

    /**
     * Duplicate a one-to-many style relation where the foreign model is ALSO
     * cloned and then associated
     *
     * @param Illuminate\Database\Eloquent\Relations\Relation $relation
     * @param string $relation_name
     * @param Illuminate\Database\Eloquent\Model $clone
     * @return void
     */
    protected function duplicateDirectRelation($relation, $relation_name, $clone)
    {
        // Loop trough current relations and clone it
        $relation->get()->each(function ($foreign) use ($clone, $relation_name) {
            $foreign_key                   = $this->resolvePrimaryKey($relation_name);
            $cloned_relation               = $foreign->replicate($this->uniqueFields);
            $cloned_relation->$foreign_key = $clone->id; // add
            $cloned_relation->save();
        });
    }

    /**
     * Duplicate a many-to-many style relation where we are just attaching the
     * relation to the dupe
     *
     * @param Illuminate\Database\Eloquent\Relations\Relation $relation
     * @param string $relation_name
     * @param Illuminate\Database\Eloquent\Model $clone
     * @return void
     */
    protected function duplicatePivotedRelation($relation, $relation_name, $clone)
    {
        // Loop trough current relations and attach to clone
        $relation->get()->each(function ($foreign) use ($clone, $relation_name) {
            $pivot_attributes = Arr::except($foreign->pivot->getAttributes(), [
                $foreign->pivot->getRelatedKey(),
                $foreign->pivot->getForeignKey(),
                $foreign->pivot->getCreatedAtColumn(),
                $foreign->pivot->getUpdatedAtColumn()
            ]);
            $clone->$relation_name()->attach($foreign, $pivot_attributes);
        });
    }
}
