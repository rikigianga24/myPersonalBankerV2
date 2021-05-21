<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Transazione;
use App\Repository\TransazioneRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;

class TransazioneController extends AbstractController
{
    /**
     * @Route("api/transazioniperiban/{iban}", name="transaziones")
     */
    public function findTransazioneByIban(Request $request, TransazioneRepository $rep, string $iban): Response
    {
        return $this->response($request,$rep->findAllByIban($iban));
    }

    public function response(Request $request , $data, $message = null , $status_code=200):Response{
        if($message != null){
            $data["error"]=$message;
        }
        $response=$this->json($data,$status_code);
        $response->headers->set("Access-Control-Allow-Origin", $request->headers->get("host"));
        $response->headers->set("Access-Control-Allow-Credentials","true");

        return $response;
    }
    /**
     * @Route("api/email/{id_transazione}")
     */
    public function findBysendMail(MailerInterface $mailer,TransazioneRepository $rep, $id_transazione):Response{
        $email = (new TemplatedEmail())
            ->from("myPersonalBankerMailer@gmail.com")
            ->to($rep->findOneBySomeField($id_transazione)[0])
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Avvenuta transazione #'.$id_transazione)
            ->htmlTemplate("/email/transaction.html.twig")
            ->context([
                "id" => $id_transazione,
                'host' => $_SERVER['HTTP_HOST']
            ]);
        $mailer->send($email);
        
        return new Response("Email inviata a ".$rep->findOneBySomeField($id_transazione)[0]);
    }
    /**
    * @Route("api/findLastTransactionForIban/{iban}")
    */
    public function findByIbanLastTransaction(TransazioneRepository $rep,string $iban):Response{
        return new Response($rep->findLast($iban)[0]);
    }
}
