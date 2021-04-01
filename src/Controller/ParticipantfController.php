<?php

namespace App\Controller;

use App\Entity\ParticipantF;
use App\Form\ParticipantFType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ParticipantfController extends AbstractController
{
    /**
     * @Route("/formation", name="formation")
     */
    public function participant(): Response
    {
        return $this->render('participantf/index.html.twig', [
            'controller_name' => 'ParticipantfController',
        ]);
    }

    /**
     * @Route("/participantf", name="participantf")
     */
    public function index(Request $request): Response
    {
        $formation= new Participantf();
        $form=$this->createForm(ParticipantFType::class , $formation);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();
           /** $participf= new Participantf();
            $participf->setIdFormation($id)
                ->setIdParticipantf($formation->getId());
            $em->persist($participf);
            $em->flush();*/
            //mailing
            $mail = new PHPMailer(true);

            try {

            $nom= $form->get('nom')->getData();
            $email = $form->get('mail')->getData();

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'omar.bensalem.1@esprit.tn';             // SMTP username
            $mail->Password   = '181JMT0940';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('omar.bensalem.1@esprit.tn', 'Hand Clasper');
            $mail->addAddress($email, 'Hand Clasper user');     // Add a recipient
            // Content
            $corps="Bonjour Monsieur/Madame ".$nom. " votre particpation est bien récu " ;
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Sois le Bienvenue pour votre entretien en ligne!';
            $mail->Body    = $corps;

            $mail->send();
            $this->addFlash('message','the email has been sent');

            } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            return $this->redirectToRoute("listformation");
        }

        return $this->render('participantf/index.html.twig', ['form' => $form->createView(),]);

    }
}
