<?php

namespace App\Console\Commands\Support\Traits;

use Illuminate\Support\Arr;

/**
 *
 */
trait TranslatableResolver
{
    public function modelIsTranslatable($translatableFields): bool
    {
        if($translatableFields==='') return false;
        return (bool)$this->translatable;
    }

    /**
     * Questo metodo serve per capire se un field è un possibile translatable.
     *
     * @param $field : Il field da controllare
     *
     * @return bool
     */
    private function isTranslatable($field): bool
    {
        // Se il campo è contenuto nei defaultTranslatable non proseguire oltre.
        if (in_array($field, $this->defaultTranslatable)) {
            return true;
        }

        // I campi senza un '_' come delimitatore lingua non sono considerati per evitare
        // che campi come ad esempio 'en' vengano considerati translatable.
        $bits = explode('_', $field);
        if (count($bits) > 0) {
            if (in_array(end($bits), $this->translatableSuffixes)) {
                return true;
            }
        }

        return false;
    }

    /**
     * This method is used  to remove duplicate fields.
     * eg: 'name_it', 'name_en', 'name_ru' became 'name'.
     */
    private function flattenTranslatableFields(): void
    {
        /*
         * Flat dei translatable fields.
         * Merge e unique delle chiavi multiple traducibili dell'array.
         *
         * Array originale: ['name_it' => [], 'name_en' => [], 'name_ru' => [], 'name_de' => [], 'name_es' => [], 'name_fr' => [], 'description' => []]
         * Obbiettivo: ['name' => [], 'description' => []]
         */
        $translatableFields = [];
        array_walk($this->fields, function ($value, $key) use (&$translatableFields) {

            if ($this->isTranslatable($key)) {

                $bits = explode('_', $key);
                $key = implode('_', array_slice($bits, 0, max(1, count($bits) - 1)));
            }

            $translatableFields[$key] = $value;
        });

        // Aggiorna i fields con il nuovo array filtrato.
        $this->fields = $translatableFields;
    }

    /**
     * Questo metodo serve per aggiungere tutti i componenti translatable allo stub.
     */
    private function setTranslatable(): void
    {
        // Flat dei translatable fields;
        $this->flattenTranslatableFields();

        // Considera solo i fields che hanno 'translatable' impostato a true.
        $translatableFields = Arr::where($this->fields, function($value, $key) {
            return $value['translatable'] == true;
        });
        $translatableFields = $this->buildFormattedArrayValues(array_keys($translatableFields));

        // Leggi gli stub.
        $translatableNamespaces = (!$this->modelIsTranslatable( $translatableFields) ) ? $this->dropLine : file_get_contents(__DIR__ . '/../Model/stubs/translatable/translatable_namespaces.stub');
        $translatableTraits = (!$this->modelIsTranslatable( $translatableFields)) ? $this->dropLine : file_get_contents(__DIR__ . '/../Model/stubs/translatable/translatable_traits.stub');
        $translatableEagerLoading = (!$this->modelIsTranslatable( $translatableFields)) ? $this->dropLine : file_get_contents(__DIR__ . '/../Model/stubs/translatable/translatable_eager.stub');
        $translatableAttributes = (!$this->modelIsTranslatable( $translatableFields)) ? $this->dropLine : str_replace('##translatable_fields##', $translatableFields, file_get_contents(__DIR__ . '/../Model/stubs/translatable/translatable_attributes.stub'));

        // Aggiungi i namespaces.

        $this->modelStub = str_replace('##translatable_namespaces##', $translatableNamespaces, $this->modelStub);

        // Aggiungi le Traits.
        $this->modelStub = str_replace('##translatable_traits##', $translatableTraits, $this->modelStub);

        // Aggiungi eager loading.
        $this->modelStub = str_replace('##translatable_eager##', $translatableEagerLoading, $this->modelStub);

        // Aggiungi i translatable attributes.
        $this->modelStub = str_replace('##translatable_attributes##', $translatableAttributes, $this->modelStub);

        if ($this->modelIsTranslatable( $translatableFields)){
            $this->writeTranslationModel();
        }

    }

}