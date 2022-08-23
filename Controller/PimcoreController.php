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

use CoreShop\Component\Resource\Factory\FactoryInterface;
use CoreShop\Component\Resource\Metadata\MetadataInterface;
use CoreShop\Component\Resource\Repository\PimcoreRepositoryInterface;
use Pimcore\Model\User;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class PimcoreController extends AdminController
{
    public function __construct(
        protected MetadataInterface $metadata,
        protected PimcoreRepositoryInterface $repository,
        protected FactoryInterface $factory,
        ViewHandlerInterface $viewHandler
    ) {
        parent::__construct($viewHandler);
    }

    /**
     * @throws AccessDeniedException
     */
    protected function isGrantedOr403(): void
    {
        if ($this->getPermission()) {
            /**
             * @var User $user
             * @psalm-var User $user
             */
            $user = method_exists($this, 'getAdminUser') ? $this->getAdminUser() : $this->getUser();

            if ($user->isAllowed($this->getPermission())) {
                return;
            }

            throw new AccessDeniedException();
        }
    }

    protected function getPermission(): string
    {
        return '';
    }
}
