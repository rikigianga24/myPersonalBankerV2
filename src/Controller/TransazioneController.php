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
use App\Repository\ContoCorrenteRepository;
use Doctrine\Migrations\Tools\TransactionHelper;

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
    
    /**
    * @Route("api/transaziones") 
    */
    public function postTransazione(Request $request, ContoCorrenteRepository $cc):Response{
            $data = json_decode($request->getContent(), true);
            $iban_destinatario=["iban"=>$data["ibanDestinatario"]];
            $destinatario=$cc->findOneBy($iban_destinatario);
            if($destinatario!=null){
                $mittente=$cc->findOneBy(["iban"=>$data["ibanMittente"]]);
                $transazione=new Transazione();
                $transazione->setIbanMittente($mittente);
                $transazione->setImporto($data["importo"]);
                $transazione->setIbanDestinatario($data["ibanDestinatario"]);
                $date = new \DateTime(date('Y-m-d H:i:s'));
                $transazione->setData($date);
                $transazione->setTipo($data["tipo"]);
                $transazione->setMovimento("Uscita");
                $em = $this->getDoctrine()->getManager();
                $em->persist($transazione);
                $em->flush();
                if($data["movimento"]=="Uscita"){
                    $mittente->setSaldo($mittente->getSaldo()-$data["importo"]);
                    $em->persist($mittente);
                    $em->flush();
                    $destinatario->setSaldo($destinatario->getSaldo()+$data["importo"]);
                    $em->persist($destinatario);
                    $em->flush();
                }else{
                    $mittente->setSaldo($mittente->getSaldo()+$data["importo"]);
                    $em->persist($mittente);
                    $em->flush();
                    $destinatario->setSaldo($destinatario->getSaldo()-$data["importo"]);
                    $em->persist($destinatario);
                    $em->flush();
                }
                return new Response("success");
            }else{
                return new Response("Iban non esistente");
            }
            
        
    }
}
