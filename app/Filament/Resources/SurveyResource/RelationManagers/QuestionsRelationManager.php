<?php

namespace App\Filament\Resources\SurveyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
                    ->required()
                    ->label('Question Text')
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
                        'text' => 'Text Input',
                        'checkbox' => 'Multiple Choice (Checkbox)',
                        'radio' => 'Single Choice (Radio)',
                        'select' => 'Dropdown (Select)',
                        'textarea' => 'Textarea (Long Text)',
                        'rating' => 'Rating (1-5)',
                    ])
                    ->required()
                    ->label('Question Type')
                    ->reactive()
                    ->columnSpanFull()
                    ->afterStateUpdated(fn (callable $set) => $set('options', null)),

                Forms\Components\KeyValue::make('options')
                    ->label('Answer Options')
                    ->keyLabel('Value')
                    ->valueLabel('Label')
                    ->visible(fn (callable $get): bool => in_array($get('type'), ['checkbox', 'radio', 'select']))
                    ->columnSpanFull(),

                Grid::make(2)
                ->schema([
                    Forms\Components\Toggle::make('is_required')
                    ->default(true)
                    ->label('Is Required'),
                    Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Is Active'),
                ]),
                
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->recordTitleAttribute('question')
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->label('Question Text')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('type')
                    ->label('Question Type')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('is_required')
                    ->label('Is Required'),
                Tables\Columns\TextColumn::make('order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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

    // public static function canReorder(): bool
    // {
    //     return true;
    // }

    // public static function getDefaultSortColumn(): ?string
    // {
    //     return 'order';
    // }
}
