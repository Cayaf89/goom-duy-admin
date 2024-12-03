<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EffectResource\Pages;
use App\Filament\Resources\EffectResource\RelationManagers;
use App\Models\Effect;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EffectResource extends Resource
{
    protected static ?string $model = Effect::class;

    protected static ?string $label = "Effet";
    protected static ?string $pluralLabel = "Effets";
    protected static ?string $navigationLabel = "Effets";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = "Goom Duy 2D";
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Grid::make(1)
                            ->columnSpan(1)
                            ->schema([
                                CuratorPicker::make('icon_id')
                                    ->relationship('icon', 'id')
                                    ->directory('effects'),
                            ]),
                        Forms\Components\Grid::make(1)
                            ->columnSpan(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\TextInput::make('short_name')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('description')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('prefab_name')
                                    ->maxLength(255),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                CuratorColumn::make('icon')
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prefab_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('short_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
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
            'index' => Pages\ListEffects::route('/'),
            'create' => Pages\CreateEffect::route('/create'),
            'edit' => Pages\EditEffect::route('/{record}/edit'),
        ];
    }
}
