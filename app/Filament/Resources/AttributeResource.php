<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttributeResource\Pages;
use App\Filament\Resources\AttributeResource\RelationManagers;
use App\Models\Attribute;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttributeResource extends Resource
{
    protected static ?string $model = Attribute::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('short_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                Forms\Components\TextInput::make('icon')
                    ->maxLength(255),
                Forms\Components\TextInput::make('min_value')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('max_value_statistic_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('short_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('min_value')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_value_statistic_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListAttributes::route('/'),
            'create' => Pages\CreateAttribute::route('/create'),
            'edit' => Pages\EditAttribute::route('/{record}/edit'),
        ];
    }
}
