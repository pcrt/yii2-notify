<?php

/**
 * @link http://www.protocollicreativi.it
 * @copyright Copyright (c) 2017 Protocolli Creativi s.n.c.
 * @license LICENSE.md
 */

namespace pcrt\component;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\console\Exception;

class Notification
{
    public $overridepath;
    public $notifier_email;
  
    public function init()
    {
        parent::init();
    }
  
    public function send($template, $fields, $to, $subject)
    {
        $_template = self::getTemplateFile($template);
        $body = Yii::$app->view->renderFile($_template, $fields);
        $result = Yii::$app->mailer->compose()
          ->setFrom($this->notifier_email)
          ->setTo($to)
          ->setSubject($subject)
          ->setHtmlBody($body)
          ->send();
    
        if ($result) {
            \Yii::info("Email sent to : " . $to . " from : " . $this->notifier_email, 'notification');
            \Yii::info("Subject : " . $subject, 'notification');
            \Yii::info("Body : \n" . $body, 'notification');
        } else {
            \Yii::error("Email not send");
        }
        \Yii::info("-----------------------------------------------------------------------------");
        \Yii::info("\n\n");
    }

    private function getTemplateFile($name)
    {
        $default = Yii::getAlias('@app') . '/mail/layouts/' . $name . '.php';
        $alternative = Yii::getAlias('@app') . $this->overridepath . $name . '.php';
    
        \Yii::info("Tryng to find alternative template email .", 'notification');
        \Yii::info("PATH : " . $alternative, 'notification');
        if (file_exists($alternative)) {
            \Yii::info("PATH FOUND", 'notification');
            return $alternative;
        }
    
        \Yii::info("Tryng to find default template email .", 'notification');
        \Yii::info("PATH : " . $default, 'notification');
        if (file_exists($default)) {
            \Yii::info("PATH FOUND", 'notification');
            return $default;
        }
        throw new \yii\base\Exception('Template file not found !', 'notification');
    }
}