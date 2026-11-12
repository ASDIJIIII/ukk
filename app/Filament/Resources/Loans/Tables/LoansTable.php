<?php

namespace App\Filament\Resources\Loans\Tables;

use App\Models\ActivityLog;
use App\Models\Loan;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('tool.name')
                    ->searchable(),
                TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('loan_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('returned_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu' => 'warning',
                        'disetujui' => 'info',
                        'ditolak' => 'danger',
                        'dikembalikan' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('fine')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('cetak')
                    ->label('Cetak Laporan')
                    ->icon('heroicon-o-printer')
                    ->url('/laporan')
                    ->openUrlInNewTab()
                    ->visible(fn () => Auth::user()?->role !== 'peminjam'),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('Setujui')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->hidden(fn (Loan $record) => $record->status !== 'menunggu' || Auth::user()?->role === 'peminjam')
                    ->action(function (Loan $record) {
                        if ($record->tool->stock < $record->qty) {
                            Notification::make()->title('Stok tidak cukup')->danger()->send();
                            return;
                        }

                        $record->tool->decrement('stock', $record->qty);
                        $record->update(['status' => 'disetujui']);
                        ActivityLog::catat("Menyetujui peminjaman #{$record->id}");
                        Notification::make()->title('Peminjaman disetujui')->success()->send();
                    }),
                Action::make('Tolak')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->hidden(fn (Loan $record) => $record->status !== 'menunggu' || Auth::user()?->role === 'peminjam')
                    ->action(function (Loan $record) {
                        $record->update(['status' => 'ditolak']);
                        ActivityLog::catat("Menolak peminjaman #{$record->id}");
                    }),
                Action::make('Kembalikan')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('info')
                    ->hidden(fn (Loan $record) => $record->status !== 'disetujui' || Auth::user()?->role === 'peminjam')
                    ->form([
                        DatePicker::make('returned_at')->default(now())->required(),
                    ])
                    ->action(function (Loan $record, array $data) {
                        $due = Carbon::parse($record->due_date);
                        $returned = Carbon::parse($data['returned_at']);
                        $lateDays = max(0, $due->diffInDays($returned, false));

                        $record->update([
                            'returned_at' => $data['returned_at'],
                            'status' => 'dikembalikan',
                            'fine' => $lateDays * 5000,
                        ]);

                        $record->tool->increment('stock', $record->qty);
                        ActivityLog::catat("Pengembalian peminjaman #{$record->id}");
                        Notification::make()->title('Alat telah dikembalikan')->success()->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}