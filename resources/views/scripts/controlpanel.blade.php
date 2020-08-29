<script>
angular.module('cpApp', []).controller('cpCtrl', ['$scope', function($scope) {
	//option == 0 nothing displayed
	//option == 1 site options displayed
	//option == 2 individual pages options displayed
    $scope.option = 0;

    $scope.storage = '/images/';

    //page custom display off when the page is loaded
    $scope.hometext = false;
    $scope.image = false;

    $scope.globalChanges = false;

    $scope.replaceType = '';

    $scope.currentPage = '';

    $scope.currentUrl = '';

    $scope.pages = [
    	@foreach ($activePages as $page)
    	'{{ $page['label'] }}', 
    	@endforeach
    ];

    //current images being used on the pages
    $scope.currentImages = {
    	@foreach ($activePages as $page)
    	'{{ $page['label'] }}': '{{$page['currentImage']['label']}}', 
    	@endforeach
    };

    $scope.currentImagesURL = {
    	@foreach ($activePages as $page)
    	'{{ $page['label'] }}': '{{$page['currentImage']['link']}}', 
    	@endforeach
    };

    $scope.currentImage = {
    	'label': '',
    	'url': '',
    };

    //archives of the images for each page
    $scope.allImages = [
    	@foreach($activePages[0]['allImages'] as $image)
    	{
    		'label': '{{$image['label']}}',
    		'url':  '{{$image['link']}}',
    	},
    	@endforeach
    ];

    //updates page display according to selection
    $scope.updateOption = function(optionInput) {
        $scope.option = optionInput;
    };

    //update page according to the page selected
    $scope.displayPageOption = function() {
    	switch(this.currentSelectedPage) {
    		case 'Home':
    			$scope.hometext = true;
    			$scope.image = true;
    			$scope.contact = false;
    			$scope.currentPage = 'Home';
    			$scope.currentImage['label'] = $scope.currentImages['Home'];
    			$scope.currentImage['url'] = $scope.storage + $scope.currentImagesURL['Home'];
    			$scope.currentUrl = $scope.currentImage['url'];
    			break;
    		case 'Contact':
    			$scope.hometext = false;
    			$scope.image = true;
    			$scope.contact = true;
    			$scope.currentPage = 'Contact';
    			$scope.currentImage['label'] = $scope.currentImages['Contact'];
    			$scope.currentImage['url'] = $scope.storage + $scope.currentImagesURL['Contact'];
    			$scope.currentUrl = $scope.currentImage['url'];
    			break;
    		//add here the custom display options for any additional page 
    		default:
    			$scope.hometext = false;
    			$scope.image = false;
    			$scope.contact = false;
    	}
    };

    $scope.updateDisplayedImage = function() {
    	console.log(this.currentSelectedImage);
    	$scope.currentUrl = $scope.storage + this.currentSelectedImage['url'];
    	$scope.$applyAsync();
    };

    $scope.loadOld = function(){
    	$scope.replaceType = 'old';
    }

    $scope.loadNew = function(){
    	$scope.replaceType = 'new';
    }

    $scope.applyGlobal = function(){
    	$scope.globalChanges = true;
    }
}]);
</script>