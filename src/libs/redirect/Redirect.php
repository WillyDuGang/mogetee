<?php

namespace src\libs\redirect;

use src\libs\alert\Alert;

class Redirect
{

    /**
     * @var string[]
     */
    private array $messages;
    private bool $isError;
    private string $location;

    /**
     * @var string[]
     */
    private array $params = [];

    public function __construct(string $location = null, array $messages = [], bool $isError = false)
    {
        $this->setLocation($location);
        $this->messages = $messages;
        $this->isError = $isError;
    }

    public function goToError(array $messages = [], array $params = [])
    {
        $this->setIsError(true);
        $this->goTo($messages, $params);
    }
    public function goTo(array $messages = [], array $params = []): void
    {
        if (!empty($messages)){
            $this->setMessages($messages);
        }
        if (!empty($params)){
           $this->params = $params;
        }
        if (!empty($this->messages)){
            Alert::setAlert($this->messages, $this->isError);
        }
        $location = $this->location;
        foreach ($this->params as $key => $value){
            $location .= "&$key=$value";
        }
        header($location);
        exit();
    }

    public function addParam(string $key, mixed $value): void
    {
        $this->params[$key] = $value;
    }

    /**
     * @param string|null $location
     * @return void
     */
    public function setLocation(?string $location): void
    {
        $header = 'Location: index.php?action=';
        $this->location = $location === null ? $header . $_GET['action'] ?? 'accueil' :  $header . $location;
    }

    private function setMessages(array $messages): void
    {
        $this->messages = $messages;
    }

    public function addMessage(string $message): void
    {
        $this->messages[] = $message;
    }

    private function setIsError(bool $isError): void
    {
        $this->isError = $isError;
    }

}