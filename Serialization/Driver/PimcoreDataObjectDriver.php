<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 */

declare(strict_types=1);

namespace CoreShop\Bundle\ResourceBundle\Serialization\Driver;

use Metadata\ClassMetadata;
use Metadata\Driver\DriverInterface;

class PimcoreDataObjectDriver implements DriverInterface
{
    public function __construct(protected DriverInterface $decorated)
    {
    }

    public function loadMetadataForClass(\ReflectionClass $class): ?ClassMetadata
    {
//        //We don't want Pimcore entities to be serialized directly
        if ($class->getNamespaceName() === \Pimcore\Model\DataObject::class) {
            return new \JMS\Serializer\Metadata\ClassMetadata($name = $class->name);
        }

        if ($class->getName() === \Pimcore\Model\DataObject\Fieldcollection::class) {
            return new \JMS\Serializer\Metadata\ClassMetadata($name = $class->name);
        }

        return $this->decorated->loadMetadataForClass($class);
    }
}
