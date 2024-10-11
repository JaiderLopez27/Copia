<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompraResource\Pages;
use App\Filament\Resources\CompraResource\RelationManagers;
use App\Models\Compra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompraResource extends Resource
{
    protected static ?string $model = Compra::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('soporteCompra')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('precioCompra')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('valorUnidad')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('proveedors_id')
                    ->relationship('proveedors', 'nombre')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('productos_id')
                    ->relationship('productos', 'nombre')
                    ->required()
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cantidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('soporteCompra')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precioCompra')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valorUnidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proveedors.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('productos.nombre')
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ForceDeleteAction::make(), // Eliminar permanentemente
                Tables\Actions\RestoreAction::make(), // Restaurar registros eliminados
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                /*Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),*/
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
            'index' => Pages\ListCompras::route('/'),
            'create' => Pages\CreateCompra::route('/create'),
            'edit' => Pages\EditCompra::route('/{record}/edit'),
        ];
    }
}
