<?php

declare(strict_types=1);

/*
 * CoreShop
 *
 * This source file is available under two different licenses:
 *  - GNU General Public License version 3 (GPLv3)
 *  - CoreShop Commercial License (CCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 *
 */

namespace CoreShop\Bundle\ResourceBundle\Form\Registry;

interface FormTypeRegistryInterface
{
    public function add(string $identifier, string $typeIdentifier, string $formType): void;

    public function get(string $identifier, string $typeIdentifier): ?string;

    public function has(string $identifier, string $typeIdentifier): bool;
}
