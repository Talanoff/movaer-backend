<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Country;
use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Wish;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->columns()
                    ->schema([
                        Forms\Components\Select::make('vendor_id')
                            ->searchable()
                            ->label(trans('forms.fields.vendor'))
                            ->relationship('vendor', 'name'),
                        Forms\Components\Select::make('user_id')
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->label(trans('forms.fields.customer'))
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state && $model = User::find($state)) {
                                    $set('details.contact.name', $model->name);
                                    $set('details.contact.email', $model->email);
                                    $set('details.contact.phone', $model->phone);
                                    $set('details.contact.locale', $model->locale);
                                }
                            })
                            ->relationship('user', 'name'),
                        Forms\Components\Fieldset::make()
                            ->label(trans('forms.fields.customer'))
                            ->schema([
                                Forms\Components\TextInput::make('details.contact.name')
                                    ->label(trans('forms.fields.simple_name')),
                                Forms\Components\TextInput::make('details.contact.email'),
                                Forms\Components\TextInput::make('details.contact.phone')
                                    ->label(trans('forms.fields.phone')),
                                Forms\Components\Select::make('details.contact.locale')
                                    ->label(trans('forms.fields.locale'))
                                    ->options(trans('forms.locales')),
                            ]),
                        Forms\Components\Select::make('status')
                            ->options(trans('forms.orders.statuses'))
                            ->required(),
                        Forms\Components\Select::make('category')
                            ->options(trans('forms.orders.categories'))
                            ->required(),
                        Forms\Components\TextInput::make('goods_number')
                            ->label(trans('forms.fields.quantity'))
                            ->required(),
                        Forms\Components\TextInput::make('goods_weight')
                            ->label(trans('forms.fields.weight').' (kg)')
                            ->required(),
                        Forms\Components\Select::make('goods_type')
                            ->label(trans('forms.fields.goods_type'))
                            ->options(trans('forms.various_goods')),
                        Forms\Components\Textarea::make('message')
                            ->rows(3)
                            ->columnSpan(2),
                    ]),
                Forms\Components\Card::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('country_from_id')
                            ->searchable()
                            ->label(trans('forms.fields.pickup_country'))
                            ->options(Country::visible()->pluck('name', 'id')),
                        Forms\Components\Select::make('country_to_id')
                            ->searchable()
                            ->label(trans('forms.fields.delivery_country'))
                            ->options(Country::visible()->pluck('name', 'id')),
                        Forms\Components\Textarea::make('address_from')
                            ->label(trans('forms.fields.pickup_address'))
                            ->rows(4)
                            ->required(),
                        Forms\Components\Textarea::make('address_to')
                            ->label(trans('forms.fields.delivery_address'))
                            ->rows(4)
                            ->required(),
                        Forms\Components\DatePicker::make('pickup_at')
                            ->label(trans('forms.fields.pickup_date'))
                            ->required(),
                        Forms\Components\DatePicker::make('delivery_at')
                            ->label(trans('forms.fields.delivery_date'))
                            ->required(),
                        Forms\Components\Select::make('pickup_location_type')
                            ->label(trans('forms.fields.pickup_location'))
                            ->options(trans('forms.location_types'))
                            ->required(),
                        Forms\Components\Select::make('delivery_location_type')
                            ->label(trans('forms.fields.delivery_location'))
                            ->options(trans('forms.location_types'))
                            ->required(),
                    ]),
                Forms\Components\Card::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('details.wishes.common.items')
                            ->label(trans('forms.fields.common_wishes'))
                            ->multiple()
                            ->options(Wish::common()->pluck('name', 'id')),
                        Forms\Components\Select::make('details.wishes.additional.items')
                            ->label(trans('forms.fields.additional_wishes'))
                            ->multiple()
                            ->options(Wish::additional()->pluck('name', 'id')),
                        Forms\Components\Textarea::make('details.wishes.additional.notes')
                            ->label(trans('forms.fields.additional_wishes_notes'))
                            ->rows(3)
                            ->columnSpan(2),
                    ]),
                Forms\Components\Card::make()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make(trans('forms.fields.attachments'))
                            ->collection('attachments')
                            ->multiple()
                            ->enableReordering(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('read_at')
                    ->label(trans('forms.fields.checked'))
                    ->alignCenter()
                    ->boolean()
                    ->options([
                        'heroicon-o-check-circle' => fn ($state): bool => $state !== null,
                    ]),
                Tables\Columns\TextColumn::make('id')
                    ->label(trans('forms.fields.order_no'))
                    ->formatStateUsing(fn (int $state) => "#$state"),
                Tables\Columns\SelectColumn::make('vendor_id')
                    ->label(trans('forms.fields.vendor'))
                    ->options(Vendor::pluck('name', 'id')),
                Tables\Columns\SelectColumn::make('status')
                    ->rules(['required'])
                    ->options(trans('forms.orders.statuses'))
                    ->disablePlaceholderSelection(),
                Tables\Columns\TextColumn::make('category')
                    ->enum(trans('forms.orders.categories')),
                Tables\Columns\TextColumn::make('goods_number')
                    ->label(trans('forms.fields.quantity'))
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('goods_weight')
                    ->label(trans('forms.fields.weight'))
                    ->formatStateUsing(fn ($state): string => "$state kg")
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('goods_type')
                    ->label(trans('forms.fields.goods_type'))
                    ->enum(trans('forms.various_goods')),
                Tables\Columns\TextColumn::make('address_from')
                    ->label(trans('forms.fields.pickup_details'))
                    ->description(fn (Order $record) => $record->pickup_at?->format('M d, Y'), position: 'above')
                    ->description(fn (Order $record) => $record->pickup_location_type->getName())
                    ->wrap(),
                Tables\Columns\TextColumn::make('address_to')
                    ->label(trans('forms.fields.delivery_details'))
                    ->description(fn (Order $record) => $record->delivery_at?->format('M d, Y'), position: 'above')
                    ->description(fn (Order $record) => $record->delivery_location_type->getName())
                    ->wrap(),
                Tables\Columns\IconColumn::make('user_id')
                    ->label(trans('forms.fields.registered'))
                    ->boolean()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(trans('forms.orders.statuses')),
                TernaryFilter::make('read_at')
                    ->label(trans('forms.fields.checked'))
                    ->nullable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::unread()->count();
    }
}
