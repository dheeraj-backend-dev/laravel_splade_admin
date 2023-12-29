<?php

namespace App\Forms;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Department;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Date;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Number;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;

class UpdateEmployeesForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
        // ->action(route('admin.employees.update'))
        ->method('PUT')
        ->class('space-y-4 p-4 bg-white rounded');
    }

    public function fields(): array
    {
        // $country = Country::pluck('name', 'id')->toArray();
        // $state = State::pluck('name', 'id')->toArray();
        $city = City::pluck('name', 'id')->toArray();
        $department = Department::pluck('name', 'id')->toArray();
        return [
            Input::make('first_name')
                ->label(__('First Name : '))
                ->rules(['required', 'max:100']),
            
            Input::make('middle_name')
                ->label(__('Middle Name : '))
                ->rules(['required', 'max:100']),

            Input::make('last_name')
                ->label(__('Last Name : '))
                ->rules(['required', 'max:100']),

            // Select::make('country_id')
            //     ->label('Country : ')
            //     ->rules(['required', 'max:100'])
            //     ->placeholder('Choose a country')
            //     ->options($country),

            // Select::make('state_id')
            //     ->label('State : ')
            //     ->rules(['required', 'max:100'])
            //     ->placeholder('Choose a state')
            //     ->options($state),

            Select::make('city_id')
                ->label('City : ')
                ->rules(['required', 'max:100'])
                ->placeholder('Choose a city')
                ->options($city),

            Select::make('department_id')
                ->label('Department : ')
                ->rules(['required', 'max:100'])
                ->placeholder('Choose a department')
                ->options($department),

            Number::make('zip_code')
                ->label('Zip Code')
                ->placeholder('Zip Code')
                ->rules(['required', 'min:6', 'max:6']),
                
            Date::make('birth_date')
                ->label(__('Birth Date : '))
                ->placeholder('Choose Date')
                ->rules(['required', 'date']),

            Date::make('hired_date')
                ->label(__('Hired Date : '))
                ->placeholder('Choose Date')
                ->rules(['required', 'date']),

            Submit::make()
                ->label(__('Submit')),
        ];
    }
}
