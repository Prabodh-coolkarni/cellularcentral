<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductsResource\Pages;
use App\Filament\Resources\ProductsResource\RelationManagers;
use App\Models\Products;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use PhpParser\Builder\Function_;


class ProductsResource extends Resource
{
    protected static ?string $model = Products::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\select::make('category')
                ->required()
                ->options(Products::category),
                
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('description')->nullable(),
                Forms\Components\TextInput::make('Brand')->required(),
                Forms\Components\TextInput::make('Model')->required(),
                Forms\Components\TextInput::make('Version')->required(),
                Forms\Components\TextInput::make('Processor')->nullable(),
                Forms\Components\TextInput::make('RAM')->nullable(),
                Forms\Components\TextInput::make('ROM')->nullable(),
                Forms\Components\TextInput::make('Color')->required(),
                Forms\Components\TextInput::make('Display_Size')->nullable(),
                Forms\Components\TextInput::make('Camera_f')->nullable(),
                Forms\Components\TextInput::make('Camera_b')->nullable(),
                Forms\Components\TextInput::make('Battery')->nullable(),
                Forms\Components\TextInput::make('Price')->required(),
                Forms\Components\FileUpload::make('Gallery')->image()->directory('images')
                ->required()
                ->multiple()
                ->minFiles(1)
                ->maxFiles(5)
                ->preserveFilenames()
                ->imagePreviewHeight(100),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    Tables\Columns\TextColumn::make('category'),
                    Tables\Columns\TextColumn::make('name'),
                    Tables\Columns\TextColumn::make('description'),
                    Tables\Columns\TextColumn::make('Brand'),
                    Tables\Columns\TextColumn::make('Model'),
                    Tables\Columns\TextColumn::make('Version'),
                    Tables\Columns\TextColumn::make('Processor'),
                    Tables\Columns\TextColumn::make('RAM'),
                    Tables\Columns\TextColumn::make('ROM'),
                    Tables\Columns\TextColumn::make('Color'),
                    Tables\Columns\TextColumn::make('Display_Size'),
                    Tables\Columns\TextColumn::make('Camera_f'),
                    Tables\Columns\TextColumn::make('Camera_b'),
                    Tables\Columns\TextColumn::make('Battery'),
                    Tables\Columns\TextColumn::make('Price'),
                    Tables\Columns\ImageColumn::make('Gallery')
                    ->getStateUsing(function ($record) {
                        $images = json_decode($record->images, true);
                        return $images ? asset('storage/' . $images[0]) : null;
                    })
                    ->width(50)
                ->height(50),
                    // ...
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }

   
}
