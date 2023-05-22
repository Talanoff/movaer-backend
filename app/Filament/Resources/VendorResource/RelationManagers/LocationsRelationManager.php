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
                    ->options(Country::visible()->pluck('name', 'id'))
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
                Tables\Actions\CreateAction::make()
                    ->form([
                        Forms\Components\Select::make('country_id')
                            ->preload()
                            ->label(trans('forms.fields.country'))
                            ->options(Country::visible()->pluck('name', 'id'))
                            ->searchable(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_default')
                            ->label(__('forms.fields.is_default')),
                    ]),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\Toggle::make('is_default')
                            ->label(__('forms.fields.is_default')),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\Select::make('country_id')
                            ->label(trans('forms.fields.country'))
                            ->options(Country::visible()->pluck('name', 'id'))
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
