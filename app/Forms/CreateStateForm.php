<?php

namespace App\Forms;

use App\Models\Country;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;

class CreateStateForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.states.store'))
            ->method('POST')
            ->class('space-y-4 p-4 bg-white rounded')
            ->fill([
                //
            ]);
    }

    public function fields(): array
    {
        $options = Country::pluck('name', 'id')->toArray();
        return [
            Input::make('name')
                ->label(__('Name : '))
                ->rules(['required', 'max:100']),

            Select::make('country_id')
                ->label('Country : ')
                ->rules(['required', 'max:100'])
                ->placeholder('Choose a country')
                ->options($options),

            Submit::make()
                ->label(__('Submit')),
        ];
    }
}
