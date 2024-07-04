<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\bill;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class BillsRelationManager extends RelationManager
{
    protected static string $relationship = 'bills';

    public function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('status')
            ->columns([
                Tables\Columns\TextColumn::make('cart.products.name')
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('cart')
                    ->label('Quantity')
                    ->getStateUsing(function (bill $record) {
                        return $record->cart->products->map(function ($product) {
                            return "{$product->pivot->quantity}";
                        })->toArray();
                    })
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('formatted_total_price')
                    ->label('Price')
                    ->money('SYP'),
                Tables\Columns\TextColumn::make('status')
                    ->sortable(),
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
