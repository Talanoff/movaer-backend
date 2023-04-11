<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('vendor_id')
                    ->relationship('vendor', 'name'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name'),
                Forms\Components\TextInput::make('nano_id')
                    ->required()
                    ->maxLength(8),
                Forms\Components\Toggle::make('status')
                    ->required(),
                Forms\Components\Toggle::make('category')
                    ->required(),
                Forms\Components\TextInput::make('goods_number'),
                Forms\Components\TextInput::make('goods_weight'),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('address_from')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address_to')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('pickup_at')
                    ->required(),
                Forms\Components\DatePicker::make('delivery_at')
                    ->required(),
                Forms\Components\Toggle::make('pickup_location_type')
                    ->required(),
                Forms\Components\Toggle::make('delivery_location_type')
                    ->required(),
                Forms\Components\TextInput::make('options')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vendor.name'),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('nano_id'),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\IconColumn::make('category')
                    ->boolean(),
                Tables\Columns\TextColumn::make('goods_number'),
                Tables\Columns\TextColumn::make('goods_weight'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('address_from'),
                Tables\Columns\TextColumn::make('address_to'),
                Tables\Columns\TextColumn::make('pickup_at')
                    ->date(),
                Tables\Columns\TextColumn::make('delivery_at')
                    ->date(),
                Tables\Columns\IconColumn::make('pickup_location_type')
                    ->boolean(),
                Tables\Columns\IconColumn::make('delivery_location_type')
                    ->boolean(),
                Tables\Columns\TextColumn::make('options'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
