<?php
namespace Db\Types;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class TinyIntType extends Type
{
    const TYPENAME = 'tinyint';

    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param mixed[] $fieldDeclaration The field declaration.
     * @param AbstractPlatform $platform The currently used database platform.
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $sql = 'TINYINT';
        if (is_numeric($fieldDeclaration['length']) && $fieldDeclaration['length'] >= 1) {
            $sql .= '(' . ((int) $fieldDeclaration['length']) . ')';
        } else {
            $sql .= '(3)';
        }
        if (!empty($fieldDeclaration['unsigned'])) {
            $sql .= ' UNSIGNED';
        }
        if (!empty($fieldDeclaration['autoincrement'])) {
            $sql .= ' AUTO_INCREMENT';
        }
        return $sql;
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     *
     * @todo Needed?
     */
    public function getName()
    {
        return 'tinyint';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (null === $value) ? null : (int) $value;
    }

    public function getBindingType()
    {
        return ParameterType::INTEGER;
    }
}
