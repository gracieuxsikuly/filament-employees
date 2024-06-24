<?php

namespace App\Filament\Resources\CityResource\RelationManagers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employees';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('country_id')
                ->label('Country')
                ->options(Country::all()->pluck('name', 'id')->toArray())
                ->required()
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('state_id', null)),
            Select::make('state_id')
                ->label('State')
                ->options(function (callable $get) {
                    $country = Country::find($get('country_id'));
                    if (!$country) {
                        return State::all()->pluck('name', 'id');
                    }
                    return $country->states->pluck('name', 'id');
                })
                ->required()
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('city_id', null)),
            Select::make('city_id')
                ->label('City')
                ->options(function (callable $get) {
                    $state = State::find($get('state_id'));
                    if (!$state) {
                        return City::all()->pluck('name', 'id');
                    }
                    return $state->cities->pluck('name', 'id');
                })
                ->required(),
            Select::make('department_id')
                // ->searchable()
                ->relationship(name: 'department', titleAttribute: 'name')->required(),
            TextInput::make('first_name')->required()->maxLength(255),
            TextInput::make('last_name')->required()->maxLength(255),
            DatePicker::make('birth_date')->required()->native(false),
            DatePicker::make('hire_date')->native(false),
            Textarea::make('address')->autosize()->minLength(2)->maxLength(1024),
            TextInput::make('zipcode')->integer(true)->maxLength(5),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('first_name')
            ->columns([
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('last_name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
