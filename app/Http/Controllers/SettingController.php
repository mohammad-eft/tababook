<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\setting;

class SettingController extends Controller
{
    public function headerSettings(){
        $logo = setting::where('meta_key', 'logo')->first();
        $heroBanner = setting::where('meta_key', 'heroBanner')->first();
        $heroTitle = setting::where('meta_key', 'heroTitle')->first();
        $heroSubtitle = setting::where('meta_key', 'heroSubtitle')->first();
        $heroPrimaryButton = setting::where('meta_key', 'heroPrimaryButton')->first();
        $heroPrimaryButtonLink = setting::where('meta_key', 'heroPrimaryButtonLink')->first();
        $heroSecondaryButton = setting::where('meta_key', 'heroSecondaryButton')->first();
        $heroSecondaryButtonLink = setting::where('meta_key', 'heroSecondaryButtonLink')->first();
        return view('admin.setting.header', [
            'logo'=>$logo,
            'heroBanner'=>$heroBanner,
            'heroTitle'=>$heroTitle,
            'heroSubtitle'=>$heroSubtitle,
            'heroPrimaryButton'=>$heroPrimaryButton,
            'heroPrimaryButtonLink'=>$heroPrimaryButtonLink,
            'heroSecondaryButton'=>$heroSecondaryButton,
            'heroSecondaryButtonLink'=>$heroSecondaryButtonLink
        ]);
    }

    public function storeHeaderSetting(Request $request){
        $settings = $request->setting;
        foreach($settings as $key=>$value){
            if($key == 'logo' || $key == 'heroBanner'){
                $name = $value->getClientOriginalName();
                $fullName = time()."_".$name;
                $path = $value->storeAs('settings', $fullName, 'public');
                $value = $path;
            }
            $value && setting::upsert(['meta_key'=>$key, 'meta_value'=>$value],['meta_key'], ['meta_value']);
        }
        return redirect()->back();
    }

    public function bannerSettings(){
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

        return view('admin.setting.banner',[
            'topBanner'=>$topBanner,
            'topBannerLink'=>$topBannerLink,
            'secondBanner'=>$secondBanner,
            'secondBannerTitle'=>$secondBannerTitle,
            'secondBannerSubtitle'=>$secondBannerSubtitle,
            'secondBannerButton'=>$secondBannerButton,
            'secondBannerButtonLink'=>$secondBannerButtonLink,
            'rightBanner'=>$rightBanner,
            'rightBannerLink'=>$rightBannerLink,
            'leftBanner'=>$leftBanner,
            'leftBannerTitle'=>$leftBannerTitle,
            'leftBannerSubtitle'=>$leftBannerSubtitle,
            'leftBannerButton'=>$leftBannerButton,
            'leftBannerButtonLink'=>$leftBannerButtonLink,
        ]);
    }

    public function storeBanners(Request $request){
        $settings = $request->setting;
        dd($settings);
    }
}
