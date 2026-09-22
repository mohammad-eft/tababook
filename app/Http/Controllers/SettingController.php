<?php

namespace App\Http\Controllers;

use App\Models\setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function headerSettings()
    {
        $logo = setting::where('meta_key', 'logo')->first();
        $heroBanner = setting::where('meta_key', 'heroBanner')->first();
        $heroTitle = setting::where('meta_key', 'heroTitle')->first();
        $heroSubtitle = setting::where('meta_key', 'heroSubtitle')->first();
        $heroPrimaryButton = setting::where('meta_key', 'heroPrimaryButton')->first();
        $heroPrimaryButtonLink = setting::where('meta_key', 'heroPrimaryButtonLink')->first();
        $heroSecondaryButton = setting::where('meta_key', 'heroSecondaryButton')->first();
        $heroSecondaryButtonLink = setting::where('meta_key', 'heroSecondaryButtonLink')->first();
        return view('admin.setting.header', [
            'logo' => $logo,
            'heroBanner' => $heroBanner,
            'heroTitle' => $heroTitle,
            'heroSubtitle' => $heroSubtitle,
            'heroPrimaryButton' => $heroPrimaryButton,
            'heroPrimaryButtonLink' => $heroPrimaryButtonLink,
            'heroSecondaryButton' => $heroSecondaryButton,
            'heroSecondaryButtonLink' => $heroSecondaryButtonLink
        ]);
    }

    public function storeHeaderSetting(Request $request)
    {
        $settings = $request->setting;
        foreach ($settings as $key => $value) {
            if ($key == 'logo' || $key == 'heroBanner') {
                $name = $value->getClientOriginalName();
                $fullName = time() . '_' . $name;
                $path = $value->storeAs('settings', $fullName, 'public');
                $value = $path;
            }
            $value && setting::upsert(['meta_key' => $key, 'meta_value' => $value], ['meta_key'], ['meta_value']);
        }
        return redirect()->back();
    }

    public function bannerSettings()
    {
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

        return view('admin.setting.banner', [
            'topBanner' => $topBanner,
            'topBannerLink' => $topBannerLink,
            'secondBanner' => $secondBanner,
            'secondBannerTitle' => $secondBannerTitle,
            'secondBannerSubtitle' => $secondBannerSubtitle,
            'secondBannerButton' => $secondBannerButton,
            'secondBannerButtonLink' => $secondBannerButtonLink,
            'rightBanner' => $rightBanner,
            'rightBannerLink' => $rightBannerLink,
            'leftBanner' => $leftBanner,
            'leftBannerTitle' => $leftBannerTitle,
            'leftBannerSubtitle' => $leftBannerSubtitle,
            'leftBannerButton' => $leftBannerButton,
            'leftBannerButtonLink' => $leftBannerButtonLink,
        ]);
    }

    public function storeBanners(Request $request)
    {
        $settings = $request->setting;
        foreach ($settings as $key => $value) {
            if ($key == 'topBanner' || $key == 'secondBanner' || $key == 'rightBanner' || $key == 'leftBanner') {
                $name = $value->getClientOriginalName();
                $fullName = time() . '_' . $name;
                $path = $value->storeAs('settings', $fullName, 'public');
                $value = $path;
            }
            $value && setting::upsert(['meta_key' => $key, 'meta_value' => $value], ['meta_key'], ['meta_value']);
        }
        return redirect()->back();
    }

    public function cardSettings()
    {
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
        $twoCardsSectionTitle = setting::where('meta_key', 'twoCardsSectionTitle')->first();  // "برای خودت می‌خری یا هدیه؟"
        $twoCardsSectionLink = setting::where('meta_key', 'twoCardsSectionLink')->first();  // "مشاهده همه →"
        return view('admin.setting.cards',[
            'twoCardsRightTitle'=>$twoCardsRightTitle,
            'twoCardsRightSubtitle'=>$twoCardsRightSubtitle,
            'twoCardsRightImage'=>$twoCardsRightImage,
            'twoCardsRightButton'=>$twoCardsRightButton,
            'twoCardsRightButtonLink'=>$twoCardsRightButtonLink,
            'twoCardsLeftTitle'=>$twoCardsLeftTitle,
            'twoCardsLeftSubtitle'=>$twoCardsLeftSubtitle,
            'twoCardsLeftImage'=>$twoCardsLeftImage,
            'twoCardsLeftButton'=>$twoCardsLeftButton,
            'twoCardsLeftButtonLink'=>$twoCardsLeftButtonLink,
            'twoCardsSectionTitle'=>$twoCardsSectionTitle,
            'twoCardsSectionLink'=>$twoCardsSectionLink,
        ]);
    }

    public function cardStore(Request $request){
        $settings = $request->setting;
        foreach ($settings as $key => $value) {
            if ($key == 'twoCardsRightImage' || $key == 'twoCardsLeftImage') {
                $name = $value->getClientOriginalName();
                $fullName = time() . '_' . $name;
                $path = $value->storeAs('settings', $fullName, 'public');
                $value = $path;
            }
            $value && setting::upsert(['meta_key' => $key, 'meta_value' => $value], ['meta_key'], ['meta_value']);
        }
        return redirect()->back();
    }
}
