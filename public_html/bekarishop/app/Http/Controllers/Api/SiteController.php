<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteImage;
use App\Models\Siteinfo;
use App\Models\SiteSocialLink;
use App\Models\SiteSeo;

class SiteController extends Controller
{
    public function site_logo()
    {
        $site_logo = SiteImage::get();
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $site_logo,
        ]);
    }

    public function site_info()
    {
        $siteinfo = Siteinfo::get();
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $siteinfo,
        ]);
    }

    public function social_link()
    {
        $social_links = SiteSocialLink::get();
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $social_links,
        ]);
    }

    public function site_seo()
    {
        $site_seos = SiteSeo::get();
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $site_seos,
        ]);
    }
}
