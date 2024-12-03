<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatisticResource\Pages;
use App\Filament\Resources\StatisticResource\RelationManagers;
use App\Models\Statistic;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatisticResource extends Resource
{
    protected static ?string $model = Statistic::class;

    protected static ?string $label           = "Statistique";
    protected static ?string $pluralLabel     = "Statistiques";
    protected static ?string $navigationLabel = "Statistiques";
    protected static ?string $navigationIcon  = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = "Goom Duy 2D";
    protected static ?int    $navigationSort  = 4;

    /**
     * @throws \Exception
     */
    public static function form(Form $form): Form {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Grid::make(1)
                            ->columnSpan(1)
                            ->schema([
                                CuratorPicker::make('icon_id')
                                    ->relationship('icon', 'id')
                                    ->directory('statistics'),
                            ]),
                        Forms\Components\Grid::make(1)
                            ->columnSpan(1)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\TextInput::make('short_name')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('prefab_name')
                                    ->maxLength(255),
                            ]),
                    ]),
                Forms\Components\Textarea::make('description')
                    ->maxLength(255),
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('base_value')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('unit')
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                CuratorColumn::make('icon')
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prefab_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('base_value')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit')
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

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index'  => Pages\ListStatistics::route('/'),
            'create' => Pages\CreateStatistic::route('/create'),
            'edit'   => Pages\EditStatistic::route('/{record}/edit'),
        ];
    }
}
