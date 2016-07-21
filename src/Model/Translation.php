<?php
namespace Translation42\Model;

use Core42\Model\AbstractModel;

/**
 * @method Translation setId() setId(int $id)
 * @method int getId() getId()
 * @method Translation setTextDomain() setTextDomain(string $textDomain)
 * @method string getTextDomain() getTextDomain()
 * @method Translation setLocale() setLocale(string $locale)
 * @method string getLocale() getLocale()
 * @method Translation setMessage() setMessage(string $message)
 * @method string getMessage() getMessage()
 * @method Translation setTranslation() setTranslation(string $translation)
 * @method string getTranslation() getTranslation()
 * @method Translation setStatus() setStatus(string $status)
 * @method string getStatus() getStatus()
 * @method Translation setUpdated() setUpdated(\DateTime $updated)
 * @method \DateTime getUpdated() getUpdated()
 * @method Translation setCreated() setCreated(\DateTime $created)
 * @method \DateTime getCreated() getCreated()
 */
class Translation extends AbstractModel
{
    const STATUS_AUTO = "auto";
    const STATUS_MANUAL = "manual";

    /**
     * @var array
     */
    public $properties = [
        'id',
        'textDomain',
        'locale',
        'message',
        'translation',
        'status',
        'updated',
        'created',
    ];
}