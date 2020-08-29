<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\SiteMessage;

use App\HomeContent;
use App\Pages;
use App\ActiveImage;
use App\Images;
use App\SiteSetup;

class InterviewController extends Controller
{
	/**
    *
    **/
    public function index() {
    	$activeImage = ActiveImage::getCurrentActiveImageFor('Home')->get()[0]->getAttributes()['link'];

    	$activeTitle = 'CDA Interview Guide';

    	$homeContent = HomeContent::getAllActiveContents()->get();
    	$homeContent = $this->dbToArray($homeContent);
    	if(sizeof($homeContent) == 1) {
    		$homeContent = $homeContent[0];
    	}

    	$siteSetup = SiteSetup::getAllSiteSetup()->get();
    	$siteSetup = $this->dbToArray($siteSetup);
    	$siteSetup = $this->cleanSiteSetup($siteSetup);

    	$noIndex = $siteSetup['noindexHome'] == 'on';

    	$activeImage = 'images/'.$activeImage;
    	return view('interview.index', compact('activeImage', 'homeContent', 'activeTitle', 'siteSetup', 'noIndex'));
    }

    /**
    *
    **/
    public function homePost(Request $request) {
    	$htmlNewContent = request('quill-html');
    	$htmlNewContent = str_replace("'", "\'", $htmlNewContent);
    	$htmlNewContent = str_replace("\\\'", "\'", $htmlNewContent);

    	$contentId = request('content-id');

    	$currentContent = HomeContent::getContent($contentId);

    	$currentContent->update([
    		'contentbody' => $htmlNewContent,
        ]);

        $changes = array('Content of the page was changed successfully.');

        $noIndex = true;
        $activeImage = '';
    	$activeTitle = '';

    	$siteSetup = SiteSetup::getAllSiteSetup()->get();
    	$siteSetup = $this->dbToArray($siteSetup);
    	$siteSetup = $this->cleanSiteSetup($siteSetup);

        return view('interview.changesapplied', compact('changes', 'activeImage', 'siteSetup', 'activeTitle', 'noIndex'));
    }

    /**
    *
    **/
    public function contact() {
    	$activeImage = ActiveImage::getCurrentActiveImageFor('Contact')->get()[0]->getAttributes()['link'];

    	$activeTitle = '';

    	$siteSetup = SiteSetup::getAllSiteSetup()->get();
    	$siteSetup = $this->dbToArray($siteSetup);
    	$siteSetup = $this->cleanSiteSetup($siteSetup);

    	$noIndex = $siteSetup['noindexContact'] == 'on';

    	$activeImage = 'images/'.$activeImage;
    	return view('interview.contact', compact('activeImage', 'siteSetup', 'activeTitle', 'noIndex'));
    }

    /**
    *
    **/
    public function contactPost(Request $request) {

    	$userInfo = array(
    		'name'	=> request('name'),
    		'email'	=> request('email'),
    		'message'	=> request('message'),
    	);

    	$companyEmail = SiteSetup::getSiteSetupFor('email')->get()[0]->getAttributes()['content'];

    	\Mail::to($companyEmail)->send(new SiteMessage($userInfo));

    	$changes = array('You message was sent successfully.');

    	$noIndex = true;
    	$activeImage = '';
    	$activeTitle = '';

    	$siteSetup = SiteSetup::getAllSiteSetup()->get();
    	$siteSetup = $this->dbToArray($siteSetup);
    	$siteSetup = $this->cleanSiteSetup($siteSetup);

    	return view('interview.changesapplied', compact('changes', 'activeImage', 'siteSetup', 'activeTitle', 'noIndex'));
    }

    /**
    *
    **/
    public function login() {
    	$activeImage = '';
    	$activeTitle = '';

    	$siteSetup = SiteSetup::getAllSiteSetup()->get();
    	$siteSetup = $this->dbToArray($siteSetup);
    	$siteSetup = $this->cleanSiteSetup($siteSetup);

    	$noIndex = true;

    	return view('interview.login', compact('activeImage', 'siteSetup', 'activeTitle', 'noIndex'));
    }

    /**
    *
    **/
    public function loginPost(Request $request) {
    	$user = request('user');
    	$password = request('password');

    	// a little embarrassing but forced due to lack of time
    	if(strtolower($user) == 'bemoadmin' and strtolower($password) == 'iwantcontrolpanel') {
    		session([
    			'user'	=> $user,
    			'admin'	=> true,
    		]);
    	} else {
    		return back()->withErrors(['Incorrect login information']);
    	}

    	return redirect('/admin');
    }

    /**
    *
    **/
    public function logout() {
    	session()->forget('user');
    	session()->forget('admin');

    	return redirect('/');
    }

    /**
    *
    **/
    public function controlPanel() {
    	$activePages = Pages::getAllActivePages()->get();
    	$activePages = $this->dbToArray($activePages);

    	$currentImage = null;
    	foreach($activePages as $key => $page) {
    		//update each page with it's currently used image
    		$currentImage = ActiveImage::getCurrentActiveImageFor($page['label'])->get();
    		$currentImage = $currentImage[0]->getAttributes();

    		$activePages[$key]['currentImage'] = $currentImage;

    		//load all images for this page (option to update the page's image with an old one)
    		$allMyImages = Images::getAllActiveImages()->get();

    		$allMyImages = $this->dbToArray($allMyImages);

    		$activePages[$key]['allImages'] = $allMyImages;

    	}

    	$activeHomeContent = HomeContent::getAllActiveContents()->get();
    	$activeHomeContent = $this->dbToArray($activeHomeContent);

    	$siteSetup = SiteSetup::getAllSiteSetup()->get();
    	$siteSetup = $this->dbToArray($siteSetup);
    	$siteSetup = $this->cleanSiteSetup($siteSetup);

    	$activeImage = '';
    	$activeTitle = '';

    	$noIndex = true;

    	return view('interview.controlpanel', compact('activeImage', 'activeTitle', 'activeHomeContent', 'activePages', 'siteSetup', 'noIndex'));
    }

    /**
    *
    **/
    public function controlPanelPost(Request $request) {

    	//images updates
    	if($request->has('replaceType')) {
    		$pageAffected = request('pageToModify');

    		if(request('replaceType') == 'old') {
    			$newImage = request('new-image');

    			$myImage = Images::getImage($newImage)->get()[0]->getAttributes()['id'];
    			$myPage = Pages::getPage($pageAffected)->get()[0]->getAttributes()['id'];

    			$currentImage = ActiveImage::getActiveImage($myPage);

    			$currentImage->update([
		    		'image' => $myImage,
		        ]);

    		} elseif(request('replaceType') == 'new') {
    			if($request->hasFile('image')) {
    				$request->image->store('images', 'public');

    				$imageName = $request->image->hashName();
    				$request->image->move(public_path('/images'), $imageName);

    				$imageLabel = request('new-label');

    				$inputImage = array(
    					'label'	=> $imageLabel,
    					'link'	=> $imageName,
    				);
    				//add image to db
    				$newImage = Images::create($inputImage);
    				$myPage = Pages::getPage($pageAffected)->get()[0]->getAttributes()['id'];

    				$currentImage = ActiveImage::getActiveImageForPage($myPage);

	    			$currentImage->update([
			    		'image' => $newImage->id,
			        ]);
    			}
    		} 
    	}

    	if($request->has('globalChanges') and request('globalChanges') == true) {
    		
    		$email = request('new-email');
    		$fbPixel = request('new-pixel');
    		$gaId = request('new-ga');

    		$niHome = 'off';
    		$niContact = 'off';

    		if($request->has('no-index-home') and request('no-index-home') == 'on') {
    			$niHome = 'on';
    		}
    		if($request->has('no-index-contact') and request('no-index-contact') == 'on') {
    			$niContact = 'on';
    		}

    		$newEmail = SiteSetup::getSiteSetupFor('email');
    		$newEmail->update([
				'content' => $email,
			]);

			$newFacebook = SiteSetup::getSiteSetupFor('facebook');
    		$newFacebook->update([
				'content' => $fbPixel,
			]);

			$newGA = SiteSetup::getSiteSetupFor('GoogleAnalytics');
    		$newGA->update([
				'content' => $gaId,
			]);

			$newNIHome = SiteSetup::getSiteSetupFor('noindexHome');
    		$newNIHome->update([
				'content' => $niHome,
			]);

			$newNIContact = SiteSetup::getSiteSetupFor('noindexContact');
    		$newNIContact->update([
				'content' => $niContact,
			]);
    	}

    	$changes = array('The site was updated successfully.');

    	$noIndex = true;
    	$activeImage = '';
    	$activeTitle = '';

    	$siteSetup = SiteSetup::getAllSiteSetup()->get();
    	$siteSetup = $this->dbToArray($siteSetup);
    	$siteSetup = $this->cleanSiteSetup($siteSetup);

    	return view('interview.changesapplied', compact('changes', 'activeImage', 'siteSetup', 'activeTitle', 'noIndex'));
    }

    /**
    *
    **/
    private function dbToArray($objectToArray) {

    	$resultArray = array();
    	foreach($objectToArray as $element) {
    		array_push($resultArray, $element->getAttributes());
    	}

    	return $resultArray;
    }

    /**
    *
    **/
    private function cleanSiteSetup($siteSetup) {
    	$newSetup = array();

    	foreach($siteSetup as $setup) {
    		$newSetup[$setup['label']] = $setup['content'];
    	}

    	return $newSetup;
    }
}
