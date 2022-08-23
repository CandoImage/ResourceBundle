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

namespace CoreShop\Bundle\ResourceBundle\Form\DataTransformer;

use CoreShop\Component\Resource\Model\ResourceInterface;
use CoreShop\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\DataTransformerInterface;

class PimcoreResourceDataTransformer implements DataTransformerInterface
{
    public function __construct(private RepositoryInterface $repository)
    {
    }

    public function transform($value)
    {
        if ($value instanceof ResourceInterface) {
            return $value->getId();
        }

        return null;
    }

    public function reverseTransform($value)
    {
        if ($value) {
            return $this->repository->find($value);
        }

        return null;
    }
}
