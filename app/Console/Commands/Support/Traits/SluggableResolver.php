<?php

namespace App\Console\Commands\Support\Traits;

trait SluggableResolver
{
    /**
     * This  method  define the sluggable attributes.
     */
    private function setSluggable(): void
    {
        $sluggableFields = array_intersect(array_keys($this->fields), $this->defaultSluggable);

        // Set ci sono degli sluggable crea tutti gli stubs.
        $sluggableAttributes = !$this->modelIsSluggable($sluggableFields) ? $this->dropLine : file_get_contents(__DIR__ . '/../Model/stubs/sluggable/sluggable_attributes.stub');
        $stubs = [];
        if ($this->modelIsSluggable($sluggableFields)) {

            $sluggableFieldStub = trim(file_get_contents(__DIR__ . '/../Model/stubs/sluggable/sluggable_field.stub'));

            foreach ($sluggableFields as $field) {
                $stubs[] = str_replace('##sluggable_field_name##', $field, $sluggableFieldStub);
            }
        }

        // Aggiungi tutti gli sluggable allo stub principale.
        $stubs = implode(",\n        ", $stubs);
        $sluggableAttributes = str_replace('##sluggable_fields##', $stubs, $sluggableAttributes);

        $this->modelStub = str_replace('##sluggable##', $sluggableAttributes, $this->modelStub);
    }


    function modelIsSluggable($sluggableFields){

        if(empty($sluggableFields)) return false;
        return (bool)$this->sluggable;

    }
}