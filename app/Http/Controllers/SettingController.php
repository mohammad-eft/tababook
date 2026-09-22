<?php

namespace App\Http\Controllers;

use App\Models\setting;
use App\Models\category;
use App\Models\product;
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
        $twoCardsSectionLinkUrl = setting::where('meta_key', 'twoCardsSectionLinkUrl')->first();  // "مشاهده همه →"
        $twoCardsSectionLinkText = setting::where('meta_key', 'twoCardsSectionLinkText')->first();  // "مشاهده همه →"
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
            'twoCardsSectionLinkUrl'=>$twoCardsSectionLinkUrl,
            'twoCardsSectionLinkText'=>$twoCardsSectionLinkText,
        ]);
    }
    
    public function cardStore(Request $request)
    {    
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

    public function serviceSettings()
    {
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
        
        return view('admin.setting.services',[
            'serviceTitle1'=>$serviceTitle1,
            'serviceSubTitle1'=>$serviceSubTitle1,
            'serviceImage1'=>$serviceImage1,
            'serviceTitle2'=>$serviceTitle2,
            'serviceSubTitle2'=>$serviceSubTitle2,
            'serviceImage2'=>$serviceImage2,
            'serviceTitle3'=>$serviceTitle3,
            'serviceSubTitle3'=>$serviceSubTitle3,
            'serviceImage3'=>$serviceImage3,
            'serviceTitle4'=>$serviceTitle4,
            'serviceSubTitle4'=>$serviceSubTitle4,
            'serviceImage4'=>$serviceImage4,
            'serviceTitle5'=>$serviceTitle5,
            'serviceSubTitle5'=>$serviceSubTitle5,
            'serviceImage5'=>$serviceImage5,
        ]);
    }

    public function serviceStore(Request $request)
    {    
        $settings = $request->all();
        foreach ($settings as $key => $value) {
            if ($key == 'serviceImage1' || $key == 'serviceImage2' || $key == 'serviceImage3' || $key == 'serviceImage4' || $key == 'serviceImage5') {
                $name = $value->getClientOriginalName();
                $fullName = time() . '_' . $name;
                $path = $value->storeAs('settings', $fullName, 'public');
                $value = $path;
            }
            $value && setting::upsert(['meta_key' => $key, 'meta_value' => $value], ['meta_key'], ['meta_value']);
        }
        return redirect()->back();
    }

    public function home(){
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

        $categories = category::all();
        // $products = product::where('show_in_home', 1)->weherNotNull('secondary_price')->get();
        $products = product::where('show_in_home', 1)->get();
        $newProducts = product::where('show_in_home', 1)->orderBy('created_at', 'desc')->limit(6)->get();
        foreach ($products as $product) {
            if ($product->media->isNotEmpty()) {
                foreach ($product->media as $media) {
                    if ($media->is_main) {
                        $product->image  = $media->media_path;
                        break;
                    } else {
                        $product->image = 'default.jpg';
                    }
                }
            } else {
                $product->image = 'default.jpg';
            }
            if ($product->secondary_price) {
                $campare = $product->primary_price - $product->secondary_price;
                $x = $campare / $product->primary_price;
                $product->percent = intval($x * 100);
            }
        }
        foreach ($newProducts as $product) {
            if ($product->media->isNotEmpty()) {
                foreach ($product->media as $media) {
                    if ($media->is_main) {
                        $product->image  = $media->media_path;
                        break;
                    } else {
                        $product->image = 'default.jpg';
                    }
                }
            } else {
                $product->image = 'default.jpg';
            }
            if ($product->secondary_price) {
                $campare = $product->primary_price - $product->secondary_price;
                $x = $campare / $product->primary_price;
                $product->percent = intval($x * 100);
            }
        }
        return view('home', ['setting'=>$setting, 'categories'=>$categories, 'products'=>$products, 'newProducts'=>$newProducts]);
    }
}
