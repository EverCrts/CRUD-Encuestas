<?php

namespace App\Filament\Resources;


use App\Filament\Resources\SurveyResource\RelationManagers\QuestionsRelationManager;
use App\Filament\Resources\SurveyResource\Pages;
use App\Filament\Resources\SurveyResource\RelationManagers;
use App\Models\Survey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Hidden;
use Filament\Facades\Filament;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\FileUpload;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SurveyResource extends Resource
{
    protected static ?string $model = Survey::class;
    protected static ?string $navigationGroup = 'Survey Management';

    protected static ?string $navigationIcon = 'heroicon-s-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Survey information')
                    ->columns(1)
                    ->description('Information about the survey')
                    ->icon('heroicon-s-document-text')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Hidden::make('user_id')->default(Filament::auth()->id()),
                        Forms\Components\Textarea::make('description')->rows(5)->columns(20),
                        Forms\Components\FileUpload::make('miniature')
                        ->image()
                        ->getUploadedFileNameForStorageUsing
                        (function ($file, $record) {
                            return 'thumbnail-survey-' . ($record?->id ?? uniqid()) . '.' . $file->getClientOriginalExtension();
                        })
                        ->disk('public')
                        ->visibility('public')
                        ->imagePreviewHeight('250px')
                        ->directory('thumbnails')
                        ->label('Thumbnail')
                        ->required(false)
                        ->previewable(true)
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            null,
                            '16:9',
                            '4:3',
                            '1:1',
                        ]),
                        Grid::make(2)
                            ->schema([
                                Forms\Components\DateTimePicker::make('start_date')
                                    ->default(now()),
                                Forms\Components\DateTimePicker::make('end_date'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Toggle::make('is_active')->required()
                                    ->default(true),
                                Forms\Components\Toggle::make('is_anonymous')->required()
                                    ->default(false),
                            ]),

                    ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_anonymous')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
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
            QuestionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSurveys::route('/'),
            'create' => Pages\CreateSurvey::route('/create'),
            'edit' => Pages\EditSurvey::route('/{record}/edit'),
        ];
    }
}

