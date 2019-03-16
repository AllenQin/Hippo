<?php
namespace App\Library\Core\Email;

interface MailInterface
{
    /**
     * Set Email origin
     *
     * @param $email
     * @param $name
     * @return mixed
     */
    public function setFrom($email, $name);

    /**
     * Add recipient Email address
     * It can be a string or an array
     *
     * @param array|string $email
     * @return mixed
     */
    public function addAddress($email);

    /**
     * Add a Cc Email address
     * It can be a string or an array
     *
     * @param $ccEmail
     * @return mixed
     */
    public function addCC($ccEmail);

    /**
     * Set email format to HTMl
     *
     * @param boolean $flag
     * @return mixed
     */
    public function isHtml($flag);

    /**
     * Set the Email subject
     *
     * @param string $subject
     * @return mixed
     */
    public function setSubject($subject);

    /**
     * Set the Email body
     *
     * @param string $body
     * @return mixed
     */
    public function setBody($body);

    /**
     * Send Email
     *
     * @return mixed
     */
    public function send();
}
