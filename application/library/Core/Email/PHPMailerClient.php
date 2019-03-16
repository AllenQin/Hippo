<?php
namespace App\Library\Core\Email;

use PHPMailer\PHPMailer\PHPMailer;

class PHPMailerClient implements MailInterface
{
    private $_mail;

    public function __construct($config)
    {
        $this->_mail = new PHPMailer();

        if ($config['smtp_debug']) {
            $this->_mail->SMTPDebug = 2;
        }

        if ($config['is_smtp']) {
            $this->_mail->isSMTP();
        }

        $this->_mail->SMTPAuth = true;
        $this->_mail->Host = $config['auth']['hosts'];
        $this->_mail->SMTPSecure = $config['auth']['smtp_secure'];
        $this->_mail->Port = $config['port'];
        $this->_mail->CharSet = 'UTF-8';
        $this->_mail->Username = $config['auth']['username'];
        $this->_mail->Password = $config['auth']['password'];

        $this->_mail->setFrom($config['auth']['username']);
        $this->_mail->addReplyTo($config['auth']['username']);
    }

    /**
     * Set Email origin
     *
     * @param $email
     * @param $name
     * @return mixed
     */
    public function setFrom($email, $name = '')
    {
        return $this->_mail->setFrom($email, $name);
    }

    /**
     * Add recipient Email address
     * It can be a string or an array
     *
     * @param array|string $email
     * @return mixed
     */
    public function addAddress($email)
    {
        if (is_array($email)) {
            foreach ($email as $address) {
                $this->_mail->addAddress($address);
            }
        } else {
            $this->_mail->addAddress($email);
        }

        return true;
    }

    /**
     * Add a Cc Email address
     * It can be a string or an array
     *
     * @param $ccEmail
     * @return mixed
     */
    public function addCC($ccEmail)
    {
        return $this->_mail->addCC($ccEmail);
    }

    /**
     * Set email format to HTMl
     *
     * @param boolean $flag
     * @return mixed
     */
    public function isHtml($flag = true)
    {
        return $this->_mail->isHTML($flag);
    }

    /**
     * Set the Email subject
     *
     * @param string $subject
     * @return mixed
     */
    public function setSubject($subject)
    {
        return $this->_mail->Subject = $subject;
    }

    /**
     * Set the Email body
     *
     * @param string $body
     * @return mixed
     */
    public function setBody($body)
    {
        return $this->_mail->Body = $body;
    }

    /**
     * Send Email
     *
     * @return mixed
     */
    public function send()
    {
        return $this->_mail->send();
    }
}
