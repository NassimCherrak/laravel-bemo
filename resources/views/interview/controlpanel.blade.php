@extends('layout.master')

@section('content')
<div class="all-content" ng-app="cpApp">
	<form action="admin" method="post" ng-controller="cpCtrl" enctype="multipart/form-data">
		@csrf
		<div>
			<ul>
				<li><button class="form-input-button" type="button" ng-click="updateOption(1)">Change site option</button></li>
				<li><button class="form-input-button" type="button" ng-click="updateOption(2)">Edit images</button></li>
			</ul>
		</div>

		<div ng-if="option==2">
			<span>Please select the page you want to work on</span></br>
			<select ng-model="currentSelectedPage" ng-options='page for page in pages'
                  ng-change='displayPageOption()'>
			</select>

			<div ng-if="hometext">
			</div>

			<div ng-if="image">
				<!-- list of available images (changes according to page selected) -->
				<div>
					<a target="_blank" ng-href="@{{ currentUrl }}">
						<img class="thumbnail" ng-src="@{{ currentUrl }}" alt="Image Preview">
					</a>
				</div>
				<span>Current background image on the page: @{{ currentImage['label'] }}</span><br/>
				<span>Select an existing image</span>
				<input type="hidden" name="pageToModify" ng-value="currentPage"/>
				<input type="hidden" name="new-image" ng-value="currentSelectedImage['label']"/>
				<input type="hidden" name="replaceType" ng-value="replaceType"/>
				<select ng-model="currentSelectedImage" ng-options='page.label for page in allImages' ng-change="updateDisplayedImage()"></select>
				<input class="form-input-button" type="submit" value="Submit the image for the @{{ currentPage }} page" ng-click="loadOld()"/>
				<br/><br/>
				<span>or</span>
				<br/><br/>
				<div>
					<span>Upload a new Image</span>
					<input type="file" name="image"/>
					<br/><br/>
					Name your new image: 
					<input class="form-input-field" type="text" name="new-label"/>
					<br/><br/>
					<input class="form-input-button" type="submit" value="Upload my new Image" ng-click="loadNew()"/>
				</div>
			</div>
		</div>


		<div ng-if="option==1">
			<div>
				<!-- input company email -->
				<span>Company email for the Contact page:</span><br/>
				<input class="form-input-field" type="email" name="new-email" value="{{ $siteSetup['email'] }}" required/><br/><br/>

				<!-- input google analytics tag -->
				<span>Google Analytics ID:</span><br/>
				<input class="form-input-field" type="text" name="new-ga" value="{{ $siteSetup['GoogleAnalytics'] }}" required/><br/><br/>

				<!-- input facebook pixel -->
				<span>Facebook Pixel:</span><br/>
				<input class="form-input-field" type="text" name="new-pixel" value="{{ $siteSetup['facebook'] }}" required/><br/><br/>

				<input type="checkbox" name="no-index-home" ng-checked="'{{ $siteSetup['noindexHome'] }}' == 'on'"/><span>No Index for Home page</span><br/>
				<input type="checkbox" name="no-index-contact" ng-checked="'{{ $siteSetup['noindexContact'] }}' == 'on'"/><span>No Index for Contact page</span><br/><br/>

				<input type="hidden" name="globalChanges" ng-value="globalChanges"/>

				<input class="form-input-button" type="submit" value="Apply changes" ng-click="applyGlobal()"/>

			</div>
			<!-- GA and FB pixel -->
		</div>
	</form>
</div>

@include('scripts.controlpanel')

@endsection