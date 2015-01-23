(function(){	
	var app = angular.module('app');

	app.controller('<?php echo $pluralHumanName; ?>Controller', function($scope, $route, $routeParams, $location) {
		$scope.$route = $route;
		$scope.$location = $location;
		$scope.$routeParams = $routeParams;
	});

	app.controller("<?php echo $pluralHumanName; ?>IndexController", function($scope, $http, components) {
		$scope.predicate = 'id';
		$scope.name = "<?php echo $pluralHumanName; ?>IndexController";
		$scope.<?php echo $pluralVar ;?> = [];
		$http.get('//api.localhost:8888/<?php echo $pluralVar ;?>/').success(function(data) {
	        $scope.<?php echo $pluralVar ;?> = data;
			components.paginate($scope, data);
	    });
	});

	app.controller("<?php echo $pluralHumanName; ?>ViewController", function($scope, $http, $routeParams) {
		$scope.name = "<?php echo $pluralHumanName; ?>ViewController";
		$scope.<?php echo $pluralVar ;?> = [];
		$http.get('//api.localhost:8888/<?php echo $pluralVar ;?>/' + $routeParams.id).success(function(data) {
	        $scope.<?php echo $pluralVar ;?> = data;
	    });
	});

	app.controller("<?php echo $pluralHumanName; ?>AddController", function($scope, $http, $routeParams, $location) {
		$scope.name = "<?php echo $pluralHumanName; ?>AddController";
		$scope.add = function(){
            $http({
            	url: '//api.localhost:8888/<?php echo $pluralVar ;?>/',
            	method: "POST",
            	data: 'body=' + JSON.stringify({<?php echo $singularHumanName; ?>:$scope.<?php echo $singularVar ;?>}),
            	headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    		}).success(function (data, status, headers, config) {
    			if(data.<?php echo $singularHumanName; ?>.type = 'success'){
    				$location.path("/");
    			} else {
    				alert('<?php echo $singularHumanName; ?> could not be added.')
    			}
        	}).error(function (data, status, headers, config) {
	        	alert(status + ' ' + data);
            });
		}
	});

	app.config(function($routeProvider) {
		$routeProvider
			.when('/', {
				templateUrl : '/view/<?php echo $pluralVar ;?>/index.html',
				controller  : '<?php echo $pluralHumanName; ?>IndexController'
			})
			.when('/view/:id', {
				templateUrl : '/view/<?php echo $pluralVar ;?>/view.html',
				controller  : '<?php echo $pluralHumanName; ?>ViewController'
			})
			.when('/add', {
				templateUrl : '/view/<?php echo $pluralVar ;?>/add.html',
				controller  : '<?php echo $pluralHumanName; ?>AddController'
			})
	});

})();