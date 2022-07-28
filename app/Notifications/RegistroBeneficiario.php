<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Notifications\RegistroBeneficiario;
use App\Notifications\BorradoBeneficiario;

class RegistroBeneficiario extends Notification
{
    use Queueable;
    protected $beneficiario;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($beneficiario)
    {
        $this->beneficiario = $beneficiario;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $beneficiario = $this->beneficiario;
        $nombre = $beneficiario->nombre;
        $apellido = $beneficiario->apellido;

        return (new MailMessage)
                    ->greeting('Hola!')
                    ->subject('Notification de Registro de Beneficiario')
                    ->line("$nombre $apellido. Fue agregado a su cuenta como beneficiario")
                    ->action('Notification Action', url('/'))
                    ->line('Gracias por ser parte de OnFlex!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
