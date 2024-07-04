<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillResource\Pages;
use App\Models\Bill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BillResource extends Resource
{
    protected static ?string $model = Bill::class;

    protected static ?string $navigationGroup = 'User Details';

    protected static ?string $navigationIcon = 'icon-bill';

    protected static ?string $activeNavigationIcon = 'icon-solid bill';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', '=', 'ongoing')->count();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'cancelled' => 'Cancelled',
                        'shipped' => 'Shipped',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.fullname')
                    ->label('Customer'),
                Tables\Columns\TextColumn::make('cart.products.name')
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('cart')
                    ->label('Quantity')
                    ->getStateUsing(function (Bill $record) {
                        return $record->cart->products->map(function ($product) {
                            return "{$product->pivot->quantity}";
                        })->toArray();
                    })
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('formatted_total_price')
                    ->label('Price')
                    ->money('SYP'),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Bill Date')
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
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
            'index' => Pages\ListBills::route('/'),
            'edit' => Pages\EditBill::route('/{record}/edit'),
        ];
    }
}
