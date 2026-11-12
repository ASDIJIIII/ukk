<?php

namespace App\Filament\Resources\Loans\Pages;

use App\Filament\Resources\Loans\LoanResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateLoan extends CreateRecord
{
    protected static string $resource = LoanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (Auth::user()?->role === 'peminjam') {
            $data['user_id'] = Auth::id();
        }

        $data['status'] = 'menunggu';

        return $data;
    }
}