<?php
/**
 * admin42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2014 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\Command\Translation;

use Core42\Command\AbstractCommand;
use Translation42\Model\Translation;

class EditCommand extends AbstractCommand
{
    /**
     * @var int
     */
    private $translationId;

    /**
     * @var Translation
     */
    private $translationModel;

    /**
     * @var string
     */
    private $textDomain;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $translation;

    /**
     * @var string
     */
    private $status;

    /**
     * @param int $translationId
     * @return $this
     */
    public function setTranslationId($translationId)
    {
        $this->translationId = $translationId;

        return $this;
    }

    /**
     * @param string $textDomain
     */
    public function setTextDomain($textDomain)
    {
        $this->textDomain = $textDomain;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param string $translation
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param array $values
     */
    public function hydrate(array $values)
    {
        $this->setTextDomain(array_key_exists('textDomain', $values) ? $values['textDomain'] : null);
        $this->setLocale(array_key_exists('locale', $values) ? $values['locale'] : null);
        $this->setMessage(array_key_exists('message', $values) ? $values['message'] : null);
        $this->setTranslation(array_key_exists('translation', $values) ? $values['translation'] : null);
        $this->setStatus(array_key_exists('status', $values) ? $values['status'] : null);
    }

    /**
     *
     */
    protected function preExecute()
    {
        if (!empty($this->translationId)) {
            $this->translationModel =
                $this->getTableGateway('Translation42\Translation')->selectByPrimary((int)$this->translationId);
        }

        if (!($this->translationModel instanceof Translation)) {
            $this->addError("user", "invalid translation");
        }

        $this->translation = (empty($this->translation)) ? null : $this->translation;

        $this->status = Translation::STATUS_MANUAL;

        if (empty($this->message)) {
            $this->addError("message", "message can't be empty");
        }
    }

    /**
     * @return Translation
     */
    protected function execute()
    {
        $dateTime = new \DateTime();

        $this->translationModel
            ->setMessage($this->message)
            ->setTranslation($this->translation)
            ->setLocale($this->locale)
            ->setTextDomain($this->textDomain)
            ->setStatus($this->status)
            ->setUpdated($dateTime);

        $this->getServiceManager()->get('TableGateway')->get('Translation42\Translation')->update($this->translationModel);

        return $this->translationModel;
    }
}
