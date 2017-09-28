<?php declare(strict_types=1);

namespace Shopware\Framework\Write\Resource;

use Shopware\Context\Struct\TranslationContext;
use Shopware\Framework\Write\Field\DateField;
use Shopware\Framework\Write\Field\IntField;
use Shopware\Framework\Write\Flag\Required;
use Shopware\Framework\Write\Resource;

class EmarketingBannersStatisticsResource extends Resource
{
    protected const BANNERID_FIELD = 'bannerID';
    protected const DISPLAY_DATE_FIELD = 'displayDate';
    protected const CLICKS_FIELD = 'clicks';
    protected const VIEWS_FIELD = 'views';

    public function __construct()
    {
        parent::__construct('s_emarketing_banners_statistics');

        $this->fields[self::BANNERID_FIELD] = (new IntField('bannerID'))->setFlags(new Required());
        $this->fields[self::DISPLAY_DATE_FIELD] = (new DateField('display_date'))->setFlags(new Required());
        $this->fields[self::CLICKS_FIELD] = (new IntField('clicks'))->setFlags(new Required());
        $this->fields[self::VIEWS_FIELD] = (new IntField('views'))->setFlags(new Required());
    }

    public function getWriteOrder(): array
    {
        return [
            \Shopware\Framework\Write\Resource\EmarketingBannersStatisticsResource::class,
        ];
    }

    public static function createWrittenEvent(array $updates, TranslationContext $context, array $errors = []): ?\Shopware\Framework\Event\EmarketingBannersStatisticsWrittenEvent
    {
        if (empty($updates) || !array_key_exists(self::class, $updates)) {
            return null;
        }

        $event = new \Shopware\Framework\Event\EmarketingBannersStatisticsWrittenEvent($updates[self::class] ?? [], $context, $errors);

        unset($updates[self::class]);

        $event->addEvent(\Shopware\Framework\Write\Resource\EmarketingBannersStatisticsResource::createWrittenEvent($updates, $context));

        return $event;
    }
}