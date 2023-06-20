<?php

namespace App\Services;
use Twilio\Rest\Client;
use App\Exceptions\ServerException;
class MessagingService
{
    /*public function __construct(
        protected UserRepository $repository,
    ) {
    }*/

    public function sendMessage($number,$body)
    {
        $twilioSid ="ACdb8a586ddf52cd4503da6fbc9d6c6cfe";
        $twilioAuthToken ="b7cb9c960d07ad5285219d3f64fed424";
        $twilioPhoneNumber ="+14066254424";

       try{
            $client = new Client($twilioSid, $twilioAuthToken);
            $message = $client->messages->create(
                    $number, // número de telefone do destinatário
                [
                    'from' => $twilioPhoneNumber,
                    'body' => $body,
                ]
            );
            return "Mensagem enviada com sucesso. SID: " . $message->sid;
        }
        catch (\Exception) {
            throw new ServerException;
        }

    }
}



