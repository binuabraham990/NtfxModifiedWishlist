<?php

declare(strict_types=1);

namespace NtfxModifiedWishlist\Subscriber;

use Shopware\Core\Framework\DataAbstractionLayer\Search\Sorting\FieldSorting;
use Shopware\Storefront\Page\Wishlist\WishListPageProductCriteriaEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WishListPageProductCriteriaEventSubscriber implements EventSubscriberInterface
{
    public function __construct()
    {
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            WishListPageProductCriteriaEvent::class => 'onCriteriaLoaded',
            GenericPageLoadedEvent::class => 'onGenericPageLoaded'
        ];
    }

    public function onCriteriaLoaded(WishListPageProductCriteriaEvent $event)
//    public function onGenericPageLoaded(WishListPageProductCriteriaEvent $event)
    {
        $criteria = $event->getCriteria();
        $criteria->resetSorting();
        $criteria->addSorting(new FieldSorting('wishlists.createdAt', FieldSorting::ASCENDING));
    }
}
