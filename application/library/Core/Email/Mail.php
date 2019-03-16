<?php
namespace App\Library\Core\Email;

class Mail
{
    private $_mail;

    public function __construct(MailInterface $mail)
    {
        $this->_mail = $mail;
    }

    /**
     * Set Email origin
     *
     * @param $emailAddress
     * @param $emailName
     * @return Mail
     */
    public function setFrom($emailAddress, $emailName)
    {
        $this->_mail->setFrom($emailAddress, $emailName);
        return $this;
    }

    /**
     * Add recipient Email address
     * It can be a string or an array
     *
     * @param array|string $email
     * @return Mail
     */
    public function addAddress($email)
    {
        $this->_mail->addAddress($email);
        return $this;
    }

    /**
     * Add a Cc Email address
     * It can be a string or an array
     *
     * @param $ccEmail
     * @return Mail
     */
    public function addCC($ccEmail)
    {
        $this->_mail->addCC($ccEmail);
        return $this;
    }

    /**
     * Set email format to HTMl
     *
     * @param boolean $flag
     * @return Mail
     */
    public function isHtml($flag)
    {
        $this->_mail->isHtml($flag);
        return $this;
    }

    /**
     * Set the Email subject
     *
     * @param string $subject
     * @return Mail
     */
    public function setSubject($subject)
    {
        $this->_mail->setSubject($subject);
        return $this;
    }

    /**
     * Set the Email body
     *
     * @param string $body
     * @return Mail
     */
    public function setBody($body)
    {
        $this->_mail->setBody($body);
        return $this;
    }

    /**
     * Send Email
     *
     * @return Mail
     */
    public function send()
    {
        return $this->_mail->send();
    }


}
