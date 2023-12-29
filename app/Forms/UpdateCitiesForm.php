<?php

namespace App\Forms;

use App\Models\State;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;

class UpdateCitiesForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->method('PUT')
            ->class('space-y-4 p-4 bg-white rounded');
    }

    public function fields(): array
    {
        $options = State::pluck('name', 'id')->toArray();
        return [
            Input::make('name')
                ->label(__('Name : '))
                ->rules(['required', 'max:100']),

            Select::make('state_id')
                ->label('State : ')
                ->rules(['required', 'max:100'])
                ->placeholder('Choose a state')
                ->options($options),

            Submit::make()
                ->label(__('Submit')),
        ];
    }
}
