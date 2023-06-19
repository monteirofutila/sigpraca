<?php

namespace App\Services;
use Twilio\Rest\Client;
class MessagingService
{
    /*public function __construct(
        protected UserRepository $repository,
    ) {
    }*/

    public function sendMessage($number)
    {
        $twilioSid ="ACdb8a586ddf52cd4503da6fbc9d6c6cfe";
        $twilioAuthToken ="f216f510aa3c2f30f9d266a91493d5db";
        $twilioPhoneNumber ="+14066254424";

        $client = new Client($twilioSid, $twilioAuthToken);
        $message = $client->messages->create(
            $number, // número de telefone do destinatário
            [
                'from' => $twilioPhoneNumber,
                'body' => 'Nota de Cobrança'
            ]
        );

        return "Mensagem enviada com sucesso. SID: " . $message->sid;
    }
}



