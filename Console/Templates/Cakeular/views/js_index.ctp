(function(){	
	var app = angular.module('app', ['ngRoute']);

	app.controller('<?php echo $pluralHumanName; ?>Controller', function($scope, $route, $routeParams, $location) {
		$scope.$route = $route;
		$scope.$location = $location;
		$scope.$routeParams = $routeParams;
	});

	app.controller("<?php echo $pluralHumanName; ?>IndexCtrl", function($scope, $http) {
		$scope.name = "<?php echo $pluralHumanName; ?>IndexCtrl";
		$scope.<?php echo $pluralVar ;?> = [];
		$http.get('//api.localhost:8888/<?php echo $pluralVar ;?>/').success(function(data) {
	        $scope.<?php echo $pluralVar ;?> = data;
	    });
	});

	app.controller("<?php echo $pluralHumanName; ?>ViewCtrl", function($scope, $http, $routeParams) {
		$scope.name = "<?php echo $pluralHumanName; ?>ViewCtrl";
		$scope.<?php echo $pluralVar ;?> = [];
		$http.get('//api.localhost:8888/<?php echo $pluralVar ;?>/' + $routeParams.id).success(function(data) {
	        $scope.<?php echo $pluralVar ;?> = data;
	    });
	});

	app.config(function($routeProvider) {
		$routeProvider
			.when('/', {
				templateUrl : '/view/<?php echo $pluralVar ;?>/index.html',
				controller  : '<?php echo $pluralHumanName; ?>IndexCtrl'
			})
			.when('/view/:id', {
				templateUrl : '/view/<?php echo $pluralVar ;?>/view.html',
				controller  : '<?php echo $pluralHumanName; ?>ViewCtrl'
			})
	});

})();