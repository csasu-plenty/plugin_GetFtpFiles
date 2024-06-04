<?php

namespace GetFtpFiles\Helpers;
use Plenty\Modules\Item\ItemImage\Contracts\ItemImageRepositoryContract;
use Plenty\Modules\Item\ItemImage\Models\ItemImage;
use Plenty\Modules\Item\Variation\Contracts\VariationLookupRepositoryContract;

class VariationHelper
{
    /**
     * @var VariationLookupRepositoryContract
     */
    private $variationLookupRepository;

    public function __construct(VariationLookupRepositoryContract $variationLookupRepository)
    {
        $this->variationLookupRepository = $variationLookupRepository;
    }

    public function getVariationByNumber($variationNumber)
    {
        $this->variationLookupRepository->hasNumber($variationNumber);
        $lookupResult = $this->variationLookupRepository->limit(1)->lookup();

        if (!empty($lookupResult)) {
            return $lookupResult[0];
        }

        return null;
    }

    public function addImageToVariation($imageData, $variationId, $position)
    {
        /** @var ItemImageRepositoryContract $itemImageRepository */
        $itemImageRepository = pluginApp(ItemImageRepositoryContract::class);

        ///** @var ItemImage[] $imageList */
        //$imageList = $itemImageRepository->findByVariationId($variationId);

        //$result = $itemImageRepository->upload($imageData);
        return 1;
    }
}