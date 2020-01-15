<?php

    namespace Controllers;    
        
    use Controllers\AdminController as AdminController; 
    use Controllers\ClientPotentialController as ClientPotentialController; 

    use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
    use PHPMailer\PHPMailer\Exception as MailerException;
    use PHPMailer\PHPMailer\SMTP as SMTP;

    require 'libs/Exception.php';
    require 'libs/PHPMailer.php';
    require 'libs/SMTP.php';

    
    class EmailController {
        
        private $adminController;
        private $clientController;
        private $clientPotentialController;
        
        public function __construct() {            
            $this->adminController = new AdminController();
        }   
        

        public function sendEmailPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Correo - Enviar";                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "send-email.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        } 
        
        public function sendEmail($check, $subject, $msg) {  
                       
            if (sizeof($check) > 0) {

                $this->clientPotentialController = new ClientPotentialController();
                $this->clientController = new ClientController(); 
                
                $recipients = array();

                if ( in_array("client", $check) ) {                    
                    $client = $this->clientController->getEmails();  
                    $recipients = array_merge($recipients, $client);
                }
                if ( in_array("client_p", $check) ) {                    
                    $client_p = $this->clientPotentialController->getEmails();            
                    $recipients = array_merge($recipients, $client_p);
                }
                if ( in_array("admin", $check) ) {                    
                    $adm = $this->adminController->getEmails();
                    $recipients = array_merge($recipients, $adm);
                }
            } 
            
            if ($this->send($recipients, $subject, $msg)) {
                return $this->sendEmailPath(null, EMAIL_SUCCESS);
            }
            return $this->sendEmailPath(EMAIL_ERROR, null);             
        }
        
        private function send($recipients, $subject, $msg) {
            
            $mail = new PHPMailer(true);

            try {                               
                $mail->SMTPDebug = 0;                                       
                $mail->isSMTP();                                            
                $mail->Host       = EMAIL_HOST;                        
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = SB_EMAIL;          
                $mail->Password   = SB_EMAIL_PASS;                           
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $mail->Port       = EMAIL_PORT;                                    

                $mail->setFrom(SB_EMAIL, 'SouthBeach Mdp');                

                foreach ($recipients as $recipient) {                    
                    $mail->addAddress($recipient);     
                }

                // Content
                $mail->isHTML(true);                                  
                $mail->Subject = $subject;
                $mail->Body    = $msg;
                $mail->AltBody = $msg;

                $mail->send();
                
                return true;
            } catch (MailerException $e) {
                return false;                             
            }
        }

    }
    
?>
