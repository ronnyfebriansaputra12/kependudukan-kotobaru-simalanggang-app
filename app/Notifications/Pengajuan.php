<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Pengajuan extends Notification
{
    use Queueable;

    protected $jenis;
    protected $pengajuan;

    /**
     * Create a new notification instance.
     */
    public function __construct($jenis, $pengajuan)
    {
        $this->jenis = $jenis;
        $this->pengajuan = $pengajuan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        if ($this->jenis == 'baru') {
            return [
                'nik' => $this->pengajuan->nik,
            ];
        } elseif ($this->jenis == 'disetujui') {
            return [
                'nama_surat' => $this->pengajuan->nama_surat,
            ];
        }

        return [];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
