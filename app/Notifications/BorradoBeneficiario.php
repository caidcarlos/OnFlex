<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BorradoBeneficiario extends Notification
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

        return (new MailMessage)
                    ->error()
                    ->greeting('Hola!')
                    ->subject('Notification de Borrado de Beneficiario')
                    ->line("$nombre $apellido. Fue borrado de su cuenta como beneficiario")
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
