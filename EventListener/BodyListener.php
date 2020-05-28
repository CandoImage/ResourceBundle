<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2015-2020 Dominik Pfaffenbauer (https://www.pfaffenbauer.at)
 * @license    https://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

declare(strict_types=1);

namespace CoreShop\Bundle\ResourceBundle\EventListener;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class BodyListener
{
    public function onKernelRequest(GetResponseEvent $event): void
    {
        $request = $event->getRequest();
        $contentType = $request->headers->get('Content-Type');

        $format = null === $contentType ? $request->getRequestFormat() : $request->getFormat($contentType);

        $content = $request->getContent();

        if ($this->isDecodeable($request)) {
            if ($format === 'json') {
                if (!empty($content)) {
                    $data = @json_decode($content, true);

                    if (is_array($data)) {
                        $request->request = new ParameterBag($data);
                    } else {
                        throw new BadRequestHttpException('Invalid ' . $format . ' message received');
                    }
                }
            }
        }
    }

    protected function isDecodeable(Request $request): bool
    {
        if (!in_array($request->getMethod(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            return false;
        }

        return !$this->isFormRequest($request);
    }

    private function isFormRequest(Request $request): bool
    {
        if (null === $request->headers->get('Content-Type')) {
            return false;
        }

        $contentTypeParts = explode(';', $request->headers->get('Content-Type'));

        if (isset($contentTypeParts[0])) {
            return in_array($contentTypeParts[0], ['multipart/form-data', 'application/x-www-form-urlencoded']);
        }

        return false;
    }
}
