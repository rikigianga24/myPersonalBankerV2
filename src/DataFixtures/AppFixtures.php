<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ContoCorrente;
use App\Entity\Transazione;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface  $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        for($i=0;$i<3;$i++){
            $utente=new User();     
            $cf="";
            for($j=0;$j<=6;$j++){
                $cf = $cf.chr(64+rand(1,26)); 
            }
            $cf=$cf.mt_rand(10,99);
            $cf=$cf.chr(64+rand(1,26));
            $cf=$cf.mt_rand(111111,999999);
            $cf=$cf.chr(64+rand(1,26));
            echo $cf."\n";
            $utente->setCf($cf);
            $utente->setNome("Nome".rand(1,10));
            $utente->setCognome("Cognome".rand(1,10));
            $utente->setCellulare(mt_rand(3470000000,3479999999));
            $utente->setCap(rand(52043,55000));
            $utente->setCivico(rand(00,99));
            $utente->setVia("Via".rand(1,10));
            $password="abcd";
            $utente->setPassword($this->encoder->encodePassword($utente,$password));
           
            $contocorrente = new ContoCorrente();
            //IT 00 A 1234567891234567891234
            $iban_construct="IT".rand(11,99).chr(64+rand(1,26)).mt_rand(11111111111,99999999999).mt_rand(11111111111,99999999999);
            echo $iban_construct."\n";
            
            $contocorrente->setIban($iban_construct);
            $contocorrente->setSaldo(mt_rand(3000.00,99999.99));
            $contocorrente->setStato(true);
            $contocorrente->setCf($utente);
            $utente->setIban($contocorrente);
            $manager->persist($utente);
            $manager->persist($contocorrente);
            
        }

        $manager->flush();
    }
}