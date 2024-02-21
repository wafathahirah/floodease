<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class aidRes extends Notification
{
    use Queueable;
    private $aid_res;

    public function __construct($aid_res)
    {
        $this->aid_res = $aid_res;
    }

    
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'ComID' => $this->aid_res->ComID ,
            'ResID' => $this->aid_res->ResID,
            'AidID' => $this->aid_res->AidID,
            'aid_ResStatus' =>$this->aid_res->aid_resStatus,
            'aid_ResQuantity' =>$this->aid_res->aid_resQuantity,
            'title' => 'Status pembahagian bantuan',
            'messages' => 'Status: ' . $this->aid_res->aid_resStatus . '<br>' . 'Lokasi: ' . $this->aid_res->resident->ResCity . '<br>' . 'Item : ' . $this->aid_res->aid_resQuantity . $this->aid_res->aid->AidType,


        ];
    }
}
