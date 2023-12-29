<?php

namespace App\Forms;

use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;

class CreateDepartmentsForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.departments.store'))
            ->method('POST')
            ->class('space-y-4 p-4 bg-white rounded')
            ->fill([
                //
            ]);
    }

    public function fields(): array
    {
        return [
            Input::make('name')
                ->label(__('Name : '))
                ->rules(['required', 'max:100']),

            Submit::make()
                ->label(__('Submit')),
        ];
    }
}
