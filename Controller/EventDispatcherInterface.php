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

namespace CoreShop\Bundle\ResourceBundle\Controller;

use CoreShop\Component\Resource\Metadata\MetadataInterface;
use CoreShop\Component\Resource\Model\ResourceInterface;
use Symfony\Component\HttpFoundation\Request;

interface EventDispatcherInterface
{
    /**
     * @param string            $eventName
     */
    public function dispatch($eventName, MetadataInterface $metadata, ResourceInterface $resource, Request $request): void;

    /**
     * @param string            $eventName
     */
    public function dispatchPreEvent($eventName, MetadataInterface $metadata, ResourceInterface $resource, Request $request): void;

    /**
     * @param string            $eventName
     */
    public function dispatchPostEvent($eventName, MetadataInterface $metadata, ResourceInterface $resource, Request $request): void;

    /**
     * @param string            $eventName
     */
    public function dispatchInitializeEvent($eventName, MetadataInterface $metadata, ResourceInterface $resource, Request $request): void;
}
