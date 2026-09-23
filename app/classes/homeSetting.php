<?php

namespace App\classes;
use App\Models\setting;

class homeSetting{
    public static function all(){
        $setting = [];
        $logo = setting::where('meta_key', 'logo')->first();
        $heroBanner = setting::where('meta_key', 'heroBanner')->first();
        $heroTitle = setting::where('meta_key', 'heroTitle')->first();
        $heroSubtitle = setting::where('meta_key', 'heroSubtitle')->first();
        $heroPrimaryButton = setting::where('meta_key', 'heroPrimaryButton')->first();
        $heroPrimaryButtonLink = setting::where('meta_key', 'heroPrimaryButtonLink')->first();
        $heroSecondaryButton = setting::where('meta_key', 'heroSecondaryButton')->first();
        $heroSecondaryButtonLink = setting::where('meta_key', 'heroSecondaryButtonLink')->first();
        $topBanner = setting::where('meta_key', 'topBanner')->first();
        $topBannerLink = setting::where('meta_key', 'topBannerLink')->first();
        $secondBanner = setting::where('meta_key', 'secondBanner')->first();
        $secondBannerTitle = setting::where('meta_key', 'secondBannerTitle')->first();
        $secondBannerSubtitle = setting::where('meta_key', 'secondBannerSubtitle')->first();
        $secondBannerButton = setting::where('meta_key', 'secondBannerButton')->first();
        $secondBannerButtonLink = setting::where('meta_key', 'secondBannerButtonLink')->first();
        $rightBanner = setting::where('meta_key', 'rightBanner')->first();
        $rightBannerLink = setting::where('meta_key', 'rightBannerLink')->first();
        $leftBanner = setting::where('meta_key', 'leftBanner')->first();
        $leftBannerTitle = setting::where('meta_key', 'leftBannerTitle')->first();
        $leftBannerSubtitle = setting::where('meta_key', 'leftBannerSubtitle')->first();
        $leftBannerButton = setting::where('meta_key', 'leftBannerButton')->first();
        $leftBannerButtonLink = setting::where('meta_key', 'leftBannerButtonLink')->first();
        
        $twoCardsSectionTitle = setting::where('meta_key', 'twoCardsSectionTitle')->first();
        $twoCardsSectionLinkUrl = setting::where('meta_key', 'twoCardsSectionLinkUrl')->first();
        $twoCardsSectionLinkText = setting::where('meta_key', 'twoCardsSectionLinkText')->first();
        $twoCardsRightTitle = setting::where('meta_key', 'twoCardsRightTitle')->first();
        $twoCardsRightSubtitle = setting::where('meta_key', 'twoCardsRightSubtitle')->first();
        $twoCardsRightImage = setting::where('meta_key', 'twoCardsRightImage')->first();
        $twoCardsRightButton = setting::where('meta_key', 'twoCardsRightButton')->first();
        $twoCardsRightButtonLink = setting::where('meta_key', 'twoCardsRightButtonLink')->first();
        $twoCardsLeftTitle = setting::where('meta_key', 'twoCardsLeftTitle')->first();
        $twoCardsLeftSubtitle = setting::where('meta_key', 'twoCardsLeftSubtitle')->first();
        $twoCardsLeftImage = setting::where('meta_key', 'twoCardsLeftImage')->first();
        $twoCardsLeftButton = setting::where('meta_key', 'twoCardsLeftButton')->first();
        $twoCardsLeftButtonLink = setting::where('meta_key', 'twoCardsLeftButtonLink')->first();

        $serviceTitle1 = setting::where('meta_key', 'serviceTitle1')->first();
        $serviceSubTitle1 = setting::where('meta_key', 'serviceSubTitle1')->first();
        $serviceImage1 = setting::where('meta_key', 'serviceImage1')->first();
        $serviceTitle2 = setting::where('meta_key', 'serviceTitle2')->first();
        $serviceSubTitle2 = setting::where('meta_key', 'serviceSubTitle2')->first();
        $serviceImage2 = setting::where('meta_key', 'serviceImage2')->first();
        $serviceTitle3 = setting::where('meta_key', 'serviceTitle3')->first();
        $serviceSubTitle3 = setting::where('meta_key', 'serviceSubTitle3')->first();
        $serviceImage3 = setting::where('meta_key', 'serviceImage3')->first();
        $serviceTitle4 = setting::where('meta_key', 'serviceTitle4')->first();
        $serviceSubTitle4 = setting::where('meta_key', 'serviceSubTitle4')->first();
        $serviceImage4 = setting::where('meta_key', 'serviceImage4')->first();
        $serviceTitle5 = setting::where('meta_key', 'serviceTitle5')->first();
        $serviceSubTitle5 = setting::where('meta_key', 'serviceSubTitle5')->first();
        $serviceImage5 = setting::where('meta_key', 'serviceImage5')->first();

        $footerBrandName = setting::where('meta_key', 'footerBrandName')->first();
        $footerBrandDescription = setting::where('meta_key', 'footerBrandDescription')->first();
        $footerServicesTitle = setting::where('meta_key', 'footerServicesTitle')->first();
        $footerCategoriesTitle = setting::where('meta_key', 'footerCategoriesTitle')->first();
        $footerAboutTitle = setting::where('meta_key', 'footerAboutTitle')->first();
        $footerPhone = setting::where('meta_key', 'footerPhone')->first();
        $footerEmail = setting::where('meta_key', 'footerEmail')->first();
        $footerAddress = setting::where('meta_key', 'footerAddress')->first();
        $footerInstagram = setting::where('meta_key', 'footerInstagram')->first();
        $footerTelegram = setting::where('meta_key', 'footerTelegram')->first();
        $footerEmailSocial = setting::where('meta_key', 'footerEmailSocial')->first();
        $footerCopyright = setting::where('meta_key', 'footerCopyright')->first();
        $footerDesignerText = setting::where('meta_key', 'footerDesignerText')->first();
        $footerDesignerPhone = setting::where('meta_key', 'footerDesignerPhone')->first();
        $footerDesignerUrl = setting::where('meta_key', 'footerDesignerUrl')->first();
        $footerServices = setting::where('meta_key', 'footerServices')->first();
        $footerCategories = setting::where('meta_key', 'footerCategories')->first();

        $setting['logo'] = $logo ? $logo->meta_value : null;
        $setting['heroBanner'] = $logo ? $heroBanner->meta_value : null;
        $setting['heroTitle'] = $logo ? $heroTitle->meta_value : null;
        $setting['heroSubtitle'] = $logo ? $heroSubtitle->meta_value : null;
        $setting['heroPrimaryButton'] = $logo ? $heroPrimaryButton->meta_value : null;
        $setting['heroPrimaryButtonLink'] = $logo ? $heroPrimaryButtonLink->meta_value : null;
        $setting['heroSecondaryButton'] = $logo ? $heroSecondaryButton->meta_value : null;
        $setting['heroSecondaryButtonLink'] = $logo ? $heroSecondaryButtonLink->meta_value : null;

        $setting['topBanner']=$topBanner ? $topBanner->meta_value : null;
        $setting['topBannerLink']=$topBannerLink ? $topBannerLink->meta_value : null;
        $setting['secondBanner']=$secondBanner ? $secondBanner->meta_value : null;
        $setting['secondBannerTitle']=$secondBannerTitle ? $secondBannerTitle->meta_value : null;
        $setting['secondBannerSubtitle']=$secondBannerSubtitle ? $secondBannerSubtitle->meta_value : null;
        $setting['secondBannerButton']=$secondBannerButton ? $secondBannerButton->meta_value : null;
        $setting['secondBannerButtonLink']=$secondBannerButtonLink ? $secondBannerButtonLink->meta_value : null;
        $setting['rightBanner']=$rightBanner ? $rightBanner->meta_value : null;
        $setting['rightBannerLink']=$rightBannerLink ? $rightBannerLink->meta_value : null;
        $setting['leftBanner']=$leftBanner ? $leftBanner->meta_value : null;
        $setting['leftBannerTitle']=$leftBannerTitle ? $leftBannerTitle->meta_value : null;
        $setting['leftBannerSubtitle']=$leftBannerSubtitle ? $leftBannerSubtitle->meta_value : null;
        $setting['leftBannerButton']=$leftBannerButton ? $leftBannerButton->meta_value : null;
        $setting['leftBannerButtonLink']=$leftBannerButtonLink ? $leftBannerButtonLink->meta_value : null;

        $setting['twoCardsSectionTitle'] =  $twoCardsSectionTitle ? $twoCardsSectionTitle->meta_value : null;
        $setting['twoCardsSectionLinkUrl'] =  $twoCardsSectionLinkUrl ? $twoCardsSectionLinkUrl->meta_value : null;
        $setting['twoCardsSectionLinkText'] =  $twoCardsSectionLinkText ? $twoCardsSectionLinkText->meta_value : null;
        $setting['twoCardsRightTitle'] =  $twoCardsRightTitle ? $twoCardsRightTitle->meta_value : null;
        $setting['twoCardsRightSubtitle'] =  $twoCardsRightSubtitle ? $twoCardsRightSubtitle->meta_value : null;
        $setting['twoCardsRightImage'] =  $twoCardsRightImage ? $twoCardsRightImage->meta_value : null;
        $setting['twoCardsRightButton'] =  $twoCardsRightButton ? $twoCardsRightButton->meta_value : null;
        $setting['twoCardsRightButtonLink'] =  $twoCardsRightButtonLink ? $twoCardsRightButtonLink->meta_value : null;
        $setting['twoCardsLeftTitle'] =  $twoCardsLeftTitle ? $twoCardsLeftTitle->meta_value : null;
        $setting['twoCardsLeftSubtitle'] =  $twoCardsLeftSubtitle ? $twoCardsLeftSubtitle->meta_value : null;
        $setting['twoCardsLeftImage'] =  $twoCardsLeftImage ? $twoCardsLeftImage->meta_value : null;
        $setting['twoCardsLeftButton'] =  $twoCardsLeftButton ? $twoCardsLeftButton->meta_value : null;
        $setting['twoCardsLeftButtonLink'] =  $twoCardsLeftButtonLink ? $twoCardsLeftButtonLink->meta_value : null;

        $setting['serviceTitle1'] = $serviceTitle1 ? $serviceTitle1->meta_value : null;
        $setting['serviceSubTitle1'] = $serviceSubTitle1 ? $serviceSubTitle1->meta_value : null;
        $setting['serviceImage1'] = $serviceImage1 ? $serviceImage1->meta_value : null;
        $setting['serviceTitle2'] = $serviceTitle2 ? $serviceTitle2->meta_value : null;
        $setting['serviceSubTitle2'] = $serviceSubTitle2 ? $serviceSubTitle2->meta_value : null;
        $setting['serviceImage2'] = $serviceImage2 ? $serviceImage2->meta_value : null;
        $setting['serviceTitle3'] = $serviceTitle3 ? $serviceTitle3->meta_value : null;
        $setting['serviceSubTitle3'] = $serviceSubTitle3 ? $serviceSubTitle3->meta_value : null;
        $setting['serviceImage3'] = $serviceImage3 ? $serviceImage3->meta_value : null;
        $setting['serviceTitle4'] = $serviceTitle4 ? $serviceTitle4->meta_value : null;
        $setting['serviceSubTitle4'] = $serviceSubTitle4 ? $serviceSubTitle4->meta_value : null;
        $setting['serviceImage4'] = $serviceImage4 ? $serviceImage4->meta_value : null;
        $setting['serviceTitle5'] = $serviceTitle5 ? $serviceTitle5->meta_value : null;
        $setting['serviceSubTitle5'] = $serviceSubTitle5 ? $serviceSubTitle5->meta_value : null;
        $setting['serviceImage5'] = $serviceImage5 ? $serviceImage5->meta_value : null;

        $setting['footerBrandName'] = $footerBrandName ? $footerBrandName->meta_value : null;
        $setting['footerBrandDescription'] = $footerBrandDescription ? $footerBrandDescription->meta_value : null;
        $setting['footerServicesTitle'] = $footerServicesTitle ? $footerServicesTitle->meta_value : null;
        $setting['footerCategoriesTitle'] = $footerCategoriesTitle ? $footerCategoriesTitle->meta_value : null;
        $setting['footerAboutTitle'] = $footerAboutTitle ? $footerAboutTitle->meta_value : null;
        $setting['footerPhone'] = $footerPhone ? $footerPhone->meta_value : null;
        $setting['footerEmail'] = $footerEmail ? $footerEmail->meta_value : null;
        $setting['footerAddress'] = $footerAddress ? $footerAddress->meta_value : null;
        $setting['footerInstagram'] = $footerInstagram ? $footerInstagram->meta_value : null;
        $setting['footerTelegram'] = $footerTelegram ? $footerTelegram->meta_value : null;
        $setting['footerEmailSocial'] = $footerEmailSocial ? $footerEmailSocial->meta_value : null;
        $setting['footerCopyright'] = $footerCopyright ? $footerCopyright->meta_value : null;
        $setting['footerDesignerText'] = $footerDesignerText ? $footerDesignerText->meta_value : null;
        $setting['footerDesignerPhone'] = $footerDesignerPhone ? $footerDesignerPhone->meta_value : null;
        $setting['footerDesignerUrl'] = $footerDesignerUrl ? $footerDesignerUrl->meta_value : null;
        $setting['footerServices'] = $footerServices ? json_decode($footerServices->meta_value) : null;
        $setting['footerCategories'] = $footerCategories ? json_decode($footerCategories->meta_value) : null;
        return $setting;
    }
    public static function document(){
        $setting = [];
        $logo = setting::where('meta_key', 'logo')->first();

        $footerBrandName = setting::where('meta_key', 'footerBrandName')->first();
        $footerBrandDescription = setting::where('meta_key', 'footerBrandDescription')->first();
        $footerServicesTitle = setting::where('meta_key', 'footerServicesTitle')->first();
        $footerCategoriesTitle = setting::where('meta_key', 'footerCategoriesTitle')->first();
        $footerAboutTitle = setting::where('meta_key', 'footerAboutTitle')->first();
        $footerPhone = setting::where('meta_key', 'footerPhone')->first();
        $footerEmail = setting::where('meta_key', 'footerEmail')->first();
        $footerAddress = setting::where('meta_key', 'footerAddress')->first();
        $footerInstagram = setting::where('meta_key', 'footerInstagram')->first();
        $footerTelegram = setting::where('meta_key', 'footerTelegram')->first();
        $footerEmailSocial = setting::where('meta_key', 'footerEmailSocial')->first();
        $footerCopyright = setting::where('meta_key', 'footerCopyright')->first();
        $footerDesignerText = setting::where('meta_key', 'footerDesignerText')->first();
        $footerDesignerPhone = setting::where('meta_key', 'footerDesignerPhone')->first();
        $footerDesignerUrl = setting::where('meta_key', 'footerDesignerUrl')->first();
        $footerServices = setting::where('meta_key', 'footerServices')->first();
        $footerCategories = setting::where('meta_key', 'footerCategories')->first();
        $topBanner = setting::where('meta_key', 'topBanner')->first();
        $topBannerLink = setting::where('meta_key', 'topBannerLink')->first();

        $setting['logo'] = $logo ? $logo->meta_value : null;
        $setting['topBanner']=$topBanner ? $topBanner->meta_value : null;
        $setting['topBannerLink']=$topBannerLink ? $topBannerLink->meta_value : null;
        $setting['footerBrandName'] = $footerBrandName ? $footerBrandName->meta_value : null;
        $setting['footerBrandDescription'] = $footerBrandDescription ? $footerBrandDescription->meta_value : null;
        $setting['footerServicesTitle'] = $footerServicesTitle ? $footerServicesTitle->meta_value : null;
        $setting['footerCategoriesTitle'] = $footerCategoriesTitle ? $footerCategoriesTitle->meta_value : null;
        $setting['footerAboutTitle'] = $footerAboutTitle ? $footerAboutTitle->meta_value : null;
        $setting['footerPhone'] = $footerPhone ? $footerPhone->meta_value : null;
        $setting['footerEmail'] = $footerEmail ? $footerEmail->meta_value : null;
        $setting['footerAddress'] = $footerAddress ? $footerAddress->meta_value : null;
        $setting['footerInstagram'] = $footerInstagram ? $footerInstagram->meta_value : null;
        $setting['footerTelegram'] = $footerTelegram ? $footerTelegram->meta_value : null;
        $setting['footerEmailSocial'] = $footerEmailSocial ? $footerEmailSocial->meta_value : null;
        $setting['footerCopyright'] = $footerCopyright ? $footerCopyright->meta_value : null;
        $setting['footerDesignerText'] = $footerDesignerText ? $footerDesignerText->meta_value : null;
        $setting['footerDesignerPhone'] = $footerDesignerPhone ? $footerDesignerPhone->meta_value : null;
        $setting['footerDesignerUrl'] = $footerDesignerUrl ? $footerDesignerUrl->meta_value : null;
        $setting['footerServices'] = $footerServices ? json_decode($footerServices->meta_value) : null;
        $setting['footerCategories'] = $footerCategories ? json_decode($footerCategories->meta_value) : null;
        return $setting;
    }
}