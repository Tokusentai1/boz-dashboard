<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartResource\Pages;
use App\Models\Cart;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CartResource extends Resource
{
    protected static ?string $model = Cart::class;

    protected static ?string $navigationGroup = 'User Details';

    protected static ?string $navigationIcon = 'icon-cart';

    protected static ?string $activeNavigationIcon = 'icon-solid cart';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordAction(null)
            ->columns([
                Tables\Columns\TextColumn::make('user.fullname')
                    ->label('Customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('products.name')
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('products')
                    ->label('Quantity')
                    ->getStateUsing(function (Cart $record) {
                        return $record->products->map(function ($product) {
                            return "{$product->pivot->quantity}";
                        })->toArray();
                    })
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('totalPrice')
                    ->label('Price')
                    ->numeric()
                    ->sortable()
                    ->prefix('SYP'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([]);
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
            'index' => Pages\ListCarts::route('/'),
        ];
    }
}
