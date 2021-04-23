<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicesResource\Pages;
use App\Filament\Resources\ServicesResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class ServicesResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('name')->autofocus()->required(),
                Components\Select::make('type')
                    ->placeholder('Select a type')
                    ->options([
                        '1' => 'Internal',
                        '2' => 'External',
                    ])
                    ->required(),
                //
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('name')->primary(),
                Columns\Text::make('type')
                    ->options([
                        '1' => 'Internal',
                        '2' => 'External',
                    ]),
            ])
            ->filters([
                Filter::make('Internal', fn ($query) => $query->where('type', '1')),
                Filter::make('External', fn ($query) => $query->where('type', '2')),
            ]);
    }

    public static function relations()
    {
        return [
            //
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListServices::routeTo('/', 'index'),
            Pages\CreateServices::routeTo('/create', 'create'),
            Pages\EditServices::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
