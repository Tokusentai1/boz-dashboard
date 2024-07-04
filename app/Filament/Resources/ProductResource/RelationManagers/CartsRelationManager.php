<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

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
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('user.fullname')
                    ->label('Customer'),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric(),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([]);
    }
}
