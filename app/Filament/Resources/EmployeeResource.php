<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
 use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Formulaire d\'enregistrement de l\'employe')
                            ->schema([
                                FileUpload::make('avatar')
                                ->getUploadedFileNameForStorageUsing(
                                    fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                        ->prepend('custom-prefix-'),
                                ),
                                TextInput::make('first_name')->required(),
                                TextInput::make('last_name'),
                                DatePicker::make('birth_date')
                                    ->native(false),
                                DatePicker::make('hire_date')
                                    ->native(false),
                                Textarea::make('address')
                                    ->autosize()
                                    ->minLength(2)
                                    ->maxLength(1024),
                                TextInput::make('zipcode')->integer(true),
                                Select::make('country_id')
                                    ->searchable()
                                    ->relationship(name: 'country', titleAttribute: 'name')->required(),
                                Select::make('state_id')
                                    ->searchable()
                                    ->relationship(name: 'state', titleAttribute: 'name')->required(),
                                Select::make('city_id')
                                    ->searchable()
                                    ->relationship(name: 'city', titleAttribute: 'name')->required(),
                                Select::make('department_id')
                                    ->searchable()
                                    ->relationship(name: 'department', titleAttribute: 'name')->required(),

                            ]),
                    ])
                    ->persistTabInQueryString()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->width('50'),
                TextColumn::make('first_name')->sortable()->searchable(),
                TextColumn::make('last_name')->sortable()->searchable(),
                TextColumn::make('department.name')->sortable()->searchable(),
                 TextColumn::make('country.name'),
                 TextColumn::make('state.name'),
                 TextColumn::make('birth_date')->date(),
                 TextColumn::make('hire_date')->date(),
                 TextColumn::make('address')->limit(50),
                 TextColumn::make('zipcode')->sortable(),
                 TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('department_id')
                    ->relationship('department', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
