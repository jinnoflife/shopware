<?php declare(strict_types=1);

namespace Shopware\Api\Seo\Event\SeoUrl;

use Shopware\Api\Entity\Search\AggregatorResult;
use Shopware\Context\Struct\ShopContext;
use Shopware\Framework\Event\NestedEvent;

class SeoUrlAggregationResultLoadedEvent extends NestedEvent
{
    public const NAME = 'seo_url.aggregation.result.loaded';

    /**
     * @var AggregatorResult
     */
    protected $result;

    public function __construct(AggregatorResult $result)
    {
        $this->result = $result;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getContext(): ShopContext
    {
        return $this->result->getContext();
    }

    public function getResult(): AggregatorResult
    {
        return $this->result;
    }
}
