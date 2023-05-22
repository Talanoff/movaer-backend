<?php

namespace App\Filament\Resources\VendorResource\RelationManagers;

use App\Models\Country;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class LocationsRelationManager extends RelationManager
{
    protected static string $relationship = 'locations';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('country_id')
                    ->label(trans('forms.fields.country'))
                    ->options(Country::pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_default')
                    ->label(__('forms.fields.is_default')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country.name'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\IconColumn::make('is_default')
                    ->alignCenter()
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn(Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\TextInput::make('quantity')
                            ->label(__('forms.fields.quantity'))
                            ->required(),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\Select::make('country_id')
                            ->label(trans('forms.fields.country'))
                            ->options(Country::pluck('name', 'id'))
                            ->searchable(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_default')
                            ->label(__('forms.fields.is_default')),
                    ]),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }
}
