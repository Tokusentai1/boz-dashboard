<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\cart;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CartsRelationManager extends RelationManager
{
    protected static string $relationship = 'carts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_id')
            ->columns([
                Tables\Columns\TextColumn::make('products.name')
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('products')
                    ->label('Quantity')
                    ->getStateUsing(function (cart $record) {
                        return $record->products->map(function ($product) {
                            return "{$product->pivot->quantity}";
                        })->toArray();
                    })
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('totalPrice')
                    ->label('Price')
                    ->money('SYP')
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
