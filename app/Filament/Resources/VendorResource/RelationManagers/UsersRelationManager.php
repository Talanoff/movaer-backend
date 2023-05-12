<?php

namespace App\Filament\Resources\VendorResource\RelationManagers;

use App\Enums\UserVendorRoleEnum;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('forms.fields.simple_name')),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('pivot.role')
                    ->label(__('forms.fields.role'))
                    ->getStateUsing(function (User $record) {
                        return $record->pivot->role->getName();
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\Select::make('role')
                            ->label(__('forms.fields.role'))
                            ->options(UserVendorRoleEnum::toArray())
                            ->required(),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\Select::make('role')
                            ->options(UserVendorRoleEnum::toArray())
                            ->required(),
                    ]),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }
}
