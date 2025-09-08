<?php

namespace App\Filament\Resources\Invoices\Pages;

use App\Filament\Resources\Invoices\InvoiceResource;
use App\Filament\Resources\Invoices\RelationManagers\PaymentsRelationManager;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('invoice-status-action')
            ->label(function ($record) {
                return match ($record->status) {
                'draft' => 'Approve Draft',
                'approved' => 'Send Invoice',
                'sent' => 'Revert To Draft',
                default => null,
                };
            })
            ->color(function ($record) {
                return match ($record->status) {
                'draft' => 'primary',
                'approved' => 'success',
                'sent' => 'warning',
                default => 'secondary',
                };
            })
            ->visible(function ($record) {
                return in_array($record->status, ['draft', 'approved','sent']);
            })
            ->action(function ($record) {
                match ($record->status) {
                'draft' => $record->update(['status' => 'approved']),
                'approved' => $record->update(['status' => 'sent']),
                'sent' => $record->update(['status' => 'draft']),
                default => null,
                };
            }),
            DeleteAction::make()
            ->visible(function ($record) {
                return $record->status === 'draft';
            }),
            Action::make('invoice-action')
            ->label(function ($record) {
                return 'Revert To Draft';
            })
            ->color(function ($record) {
                return 'warning';
            })
            ->visible(function ($record) {
                return in_array($record->status, ['approved']);
            })
            ->action(function ($record) {
                $record->update(['status' => 'draft']);
            }),
        ];
    }

    protected function isReadOnly(): bool
    {
        return true;
    }

    protected function beforeSave(): void
    {
        if($this->getRecord()->status === 'sent' || $this->getRecord()->status === 'approved') {
            Notification::make()
            ->warning()
            ->title('Your invoice is currently marked as "'.$this->getRecord()->status.'"')
            ->body('Set your invoice back to "Draft" to make changes.')
            ->persistent()
            ->send();
            $this->halt();
        }
    }
}
