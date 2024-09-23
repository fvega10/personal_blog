<?php 
    namespace MyApp\Utils{
        
    class Message
    {
        private $title     = null;
        private $mainText  = null;
        private $extraText = null;
        private $level     = 'alert';

        public function __construct()
        {
            
        }

        public function getTitle()
        {
            return $this->title;
        }

        public function getMessage()
        {
            return $this->mainText;
        }

        public function getExtraMessage()
        {
            return $this->extraText;
        }

        public function getLevel()
        {
            return $this->level;
        }

        public function setPrimaryMessage($title, $mainMessage, $extraMessage)
        {
            $this->title = $title;
            $this->mainText = $mainMessage;
            $this->extraText = $extraMessage;
            $this->level = "alert-primary";
        }

        public function setSecondaryMessage($title, $mainMessage, $extraMessage)
        {
            $this->title = $title;
            $this->mainText = $mainMessage;
            $this->extraText = $extraMessage;
            $this->level = "alert-secondary";
        }

        public function setSuccessMessage($title, $mainMessage, $extraMessage)
        {
            $this->title = $title;
            $this->mainText = $mainMessage;
            $this->extraText = $extraMessage;
            $this->level = "alert-success";
        }

        public function setDangerMessage($title, $mainMessage, $extraMessage)
        {
            $this->title = $title;
            $this->mainText = $mainMessage;
            $this->extraText = $extraMessage;
            $this->level = "alert-danger";
        }

        public function setWarningMessage($title, $mainMessage, $extraMessage)
        {
            $this->title = $title;
            $this->mainText = $mainMessage;
            $this->extraText = $extraMessage;
            $this->level = "alert-warning";
        }

        public function setInfoMessage($title, $mainMessage, $extraMessage)
        {
            $this->title = $title;
            $this->mainText = $mainMessage;
            $this->extraText = $extraMessage;
            $this->level = "alert-info";
        }

        public function setLightMessage($title, $mainMessage, $extraMessage)
        {
            $this->title = $title;
            $this->mainText = $mainMessage;
            $this->extraText = $extraMessage;
            $this->level = "alert-light";
        }

        public function setDarkMessage($title, $mainMessage, $extraMessage)
        {
            $this->title = $title;
            $this->mainText = $mainMessage;
            $this->extraText = $extraMessage;
            $this->level = "alert-dark";
        }

    }
}