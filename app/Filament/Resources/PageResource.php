<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('EN')
                    ->schema([
                        Forms\Components\TextInput::make('title.en')
                            ->label(__('forms.fields.title', ['locale' => 'en']))
                            ->required(),
                        Forms\Components\RichEditor::make('content.en')
                            ->label(__('forms.fields.content', ['locale' => 'en']))
                            ->required(),
                    ])
                    ->collapsible(),
                Forms\Components\Section::make('NL')
                    ->schema([
                        Forms\Components\TextInput::make('title.nl')
                            ->label(__('forms.fields.title', ['locale' => 'nl']))
                            ->required(),
                        Forms\Components\RichEditor::make('content.nl')
                            ->label(__('forms.fields.content', ['locale' => 'nl']))
                            ->required(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
