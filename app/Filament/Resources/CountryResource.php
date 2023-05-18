<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Models\Country;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name.en')
                    ->label(__('forms.fields.name', ['locale' => 'en']))
                    ->required(),
                Forms\Components\TextInput::make('name.nl')
                    ->label(__('forms.fields.name', ['locale' => 'nl']))
                    ->required(),
                Forms\Components\Toggle::make('is_visible')
                    ->label(__('forms.fields.visible'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('alpha2')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('locations_count')
                    ->alignCenter()
                    ->counts('locations'),
                Tables\Columns\IconColumn::make('is_visible')
                    ->alignCenter()
                    ->label(__('forms.fields.visible'))
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\Filter::make(__('forms.fields.visible'))
                    ->query(fn (Builder $query): Builder => $query->where('is_visible', 1)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
