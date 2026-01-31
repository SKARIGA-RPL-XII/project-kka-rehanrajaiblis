<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Consultation;

class NewConsultationNotification extends Notification
{
    use Queueable;

    protected $consultation;

    public function __construct(Consultation $consultation)
    {
        $this->consultation = $consultation;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'consultation_id' => $this->consultation->id,
            'patient_name' => $this->consultation->user->name,
            'subject' => $this->consultation->subject,
            'message' => 'Konsultasi baru dari ' . $this->consultation->user->name,
        ];
    }
}
