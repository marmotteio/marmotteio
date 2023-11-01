<?php

namespace App\Traits;

use App\Models\CustomField;
use Filament\Facades\Filament;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ViewField;
use Illuminate\Database\Eloquent\Model;

trait HasCustomFields
{
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return static::handleRecordUpdateStatic($record, $data);
    }

    protected static function handleRecordUpdateStatic(Model $record, array $data): Model
    {
        $customFieldsData = [];

        if (isset($data['custom_fields'])) {
            $customFieldsData = $data['custom_fields'];
            unset($data['custom_fields']);
        }

        $record->update($data);

        if (! empty($customFieldsData)) {
            static::saveCustomFields($customFieldsData, $record);
        }

        return $record;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $customFieldsData = [];

        if (isset($data['custom_fields'])) {
            $customFieldsData = $data['custom_fields'];
            unset($data['custom_fields']);
        }

        $record = new ($this->getModel())($data);

        if ($tenant = Filament::getTenant()) {
            $record = $this->associateRecordWithTenant($record, $tenant);
        } else {
            $record->save();
        }

        if (! empty($customFieldsData)) {
            static::saveCustomFields($customFieldsData, $record);
        }

        return $record;
    }

    protected function associateRecordWithTenant(Model $record, Model $tenant): Model
    {
        $relationship = static::getResource()::getTenantRelationship($tenant);

        if ($relationship instanceof HasManyThrough) {
            $record->save();

            return $record;
        }

        return $relationship->save($record);
    }

    public static function customFieldsSchema($modelClass)
    {
        $customFields = CustomField::where('applicable_model', $modelClass)->get();
        $schema = [];

        foreach ($customFields as $customField) {
            $component = null;

            $valueCallback = function (?Model $record) use ($customField) {
                if (! $record) {
                    return null;
                }

                $customFieldValue = $record->customFieldValues()
                    ->where('custom_field_id', $customField->id)
                    ->first();

                return $customFieldValue ? $customFieldValue->value : null;
            };

            switch ($customField->field_type) {
                case 'text':
                    $component = \Filament\Forms\Components\TextInput::make('custom_fields.'.$customField->name)
                        ->label($customField->name)
                        ->formatStateUsing($valueCallback);
                    break;

                case 'number':
                    $component = \Filament\Forms\Components\TextInput::make('custom_fields.'.$customField->name)
                        ->label($customField->name)
                        ->numeric()
                        ->formatStateUsing($valueCallback);
                    break;

                case 'date':
                    $component = \Filament\Forms\Components\DatePicker::make('custom_fields.'.$customField->name)
                        ->label($customField->name)
                        ->formatStateUsing($valueCallback);
                    break;
            }

            if ($component) {
                $schema[] = $component;
            }
        }

        $columnsCount = 3;

        if (empty($schema)) {
            $columnsCount = 1;
            $schema[] = ViewField::make('text')->view('filament.components.text');
        }

        return Section::make('Custom fields')
            ->description('Please fill in the following custom fields')
            ->columns($columnsCount)
            ->schema($schema);
    }

    public static function saveCustomFields(array $customFieldsData, Model $model)
    {
        foreach ($customFieldsData as $fieldName => $fieldValue) {
            $customField = CustomField::where('name', $fieldName)
                ->where('applicable_model', get_class($model))
                ->first();

            if ($customField) {
                $value = $model->customFieldValues()->firstOrNew([
                    'custom_field_id' => $customField->id,
                    'team_id' => Filament::getTenant()->id,
                ]);

                $value->value = $fieldValue;
                $value->save();
            }
        }
    }
}
