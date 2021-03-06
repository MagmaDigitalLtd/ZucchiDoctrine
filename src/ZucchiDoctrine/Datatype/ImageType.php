<?php
/**
 * ZucchiDoctrine (http://zucchi.co.uk)
 *
 * @link      http://github.com/zucchi/ZucchiDoctrine for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zucchi Limited. (http://zucchi.co.uk)
 * @license   http://zucchi.co.uk/legals/bsd-license New BSD License
 */
namespace ZucchiDoctrine\Datatype;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\JsonArrayType;

use Zend\Json\Json;

use Zucchi\Image\Image;

/**
 * Type that works a a float value but can then be identified as monetary value
 *
 * @author Matt Cockayne <matt@zucchi.co.uk>
 * @package ZucchiDoctrine 
 * @subpackage Datatype
 */
class ImageType extends JsonArrayType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return Json::encode($value);
    }

    /**
     * Converts a value from its database representation to its PHP representation
     * of this type.
     *
     * @param mixed $value The value to convert.
     * @param AbstractPlatform $platform The currently used database platform.
     * @return mixed The PHP representation of the value.
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            $image = new Image();
        } else {
            $image = new Image((array)Json::decode($value));
        }
        return $image;
    }
}
