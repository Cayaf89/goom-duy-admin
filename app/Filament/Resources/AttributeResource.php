<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttributeResource\Pages;
use App\Filament\Resources\AttributeResource\RelationManagers;
use App\Models\Attribute;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
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

    protected static ?string $label           = "Attribut";
    protected static ?string $pluralLabel     = "Attributs";
    protected static ?string $navigationLabel = "Attributs";
    protected static ?string $navigationIcon  = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = "Goom Duy 2D";
    protected static ?int    $navigationSort  = 3;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Grid::make(1)
                            ->columnSpan(1)
                            ->schema([
                                CuratorPicker::make('icon_id')
                                    ->relationship('icon', 'id')
                                    ->directory('attributes'),
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
                Forms\Components\TextInput::make('min_value')
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('max_value_statistic_id')
                    ->relationship('statistic', 'name')
                    ->native(false)
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->modifyQueryUsing(fn($query) => $query->with('statistic'))
            ->columns([
                CuratorColumn::make('icon')
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prefab_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('min_value')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statistic')
                    ->label("Max value")
                    ->formatStateUsing(fn($state) => $state->base_value . ' ' . $state->unit)
                    ->sortable(),
                Tables\Columns\TextColumn::make('statistic.name')
                    ->label("Max value statistic")
                    ->badge()
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

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index'  => Pages\ListAttributes::route('/'),
            'create' => Pages\CreateAttribute::route('/create'),
            'edit'   => Pages\EditAttribute::route('/{record}/edit'),
        ];
    }
}
