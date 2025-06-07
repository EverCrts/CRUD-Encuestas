<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Question;
use App\Models\Survey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\CastToJson;


class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Select::make('survey_id')
                    ->required()
                    // ->numeric()
                    ->options(Survey::all()->pluck('id', 'id'))
                    ->label('Survey ID'),
                Forms\Components\TextInput::make('question')
                    ->required(),
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
                ->afterStateUpdated(fn (callable $set) => $set('options', null)),

                Forms\Components\KeyValue::make('options')
                    ->label('Answer Options')
                    ->keyLabel('Value')
                    ->valueLabel('Label')
                    ->visible(fn (callable $get): bool => in_array($get('type'), ['checkbox', 'radio', 'select']))
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),

                Grid::make(2)
                    ->schema([
                        Forms\Components\Toggle::make('is_required')
                            ->default(true)
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('survey_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('question')

                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_required')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->toggleable(isToggledHiddenByDefault: true)
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
{
    return false;
}
}
