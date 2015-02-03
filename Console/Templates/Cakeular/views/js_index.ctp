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
		$http.get('//<?php echo Configure::read('Cakeular.api_url') ?>/<?php echo $pluralVar ;?>/').success(function(data) {
	        $scope.<?php echo $pluralVar ;?> = data;
			components.paginate($scope, data);
	    });
	});

	app.controller("<?php echo $pluralHumanName; ?>ViewController", function($scope, $http, $routeParams) {
		$scope.name = "<?php echo $pluralHumanName; ?>ViewController";
		$scope.<?php echo $pluralVar ;?> = [];
		$http.get('//<?php echo Configure::read('Cakeular.api_url') ?>/<?php echo $pluralVar ;?>/' + $routeParams.id).success(function(data) {
	        $scope.<?php echo $pluralVar ;?> = data;
	    });
	});

	app.controller("<?php echo $pluralHumanName; ?>AddController", function($scope, $http, $routeParams, $location) {
		$scope.name = "<?php echo $pluralHumanName; ?>AddController";
<?php if (!empty($associations['belongsTo'])):
	foreach ($associations['belongsTo'] as $alias => $details): ?>
		$scope.<?php echo $details['controller']; ?> = [];
		$http.get('//<?php echo Configure::read('Cakeular.api_url') ?>/<?php echo $details['controller']; ?>/').success(function(data) {
	        $scope.<?php echo $details['controller']; ?> = data;
	    });
<?php break;
endforeach;
endif; ?>
		$scope.send = function(){
            $http({
            	url: '//<?php echo Configure::read('Cakeular.api_url') ?>/<?php echo $pluralVar ;?>/',
            	method: "POST",
            	data: 'body=' + JSON.stringify({<?php echo $singularHumanName; ?>:$scope.<?php echo $pluralVar ?>.<?php echo $singularHumanName ;?>}),
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

	app.controller("<?php echo $pluralHumanName; ?>EditController", function($scope, $http, $routeParams, $location) {
		$scope.name = "<?php echo $pluralHumanName; ?>EditController";
<?php if (!empty($associations['belongsTo'])):
	foreach ($associations['belongsTo'] as $alias => $details): ?>
		$scope.<?php echo $details['controller']; ?> = [];
		$http.get('//<?php echo Configure::read('Cakeular.api_url') ?>/<?php echo $details['controller']; ?>/').success(function(data) {
	        $scope.<?php echo $details['controller']; ?> = data;
	    });
<?php break;
endforeach;
endif; ?>
		$scope.<?php echo $pluralVar ;?> = [];
		$http.get('//<?php echo Configure::read('Cakeular.api_url') ?>/<?php echo $pluralVar ;?>/' + $routeParams.id).success(function(data) {
	        $scope.<?php echo $pluralVar ;?> = data;
	    });
		$scope.send = function(){
            $http({
            	url: '//<?php echo Configure::read('Cakeular.api_url') ?>/<?php echo $pluralVar ;?>/' + $routeParams.id,
            	method: "PUT",
            	data: 'body=' + JSON.stringify({<?php echo $singularHumanName; ?>:$scope.<?php echo $pluralVar ?>.<?php echo $singularHumanName ;?>}),
            	headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    		}).success(function (data, status, headers, config) {
    			if(data.<?php echo $singularHumanName; ?>.type = 'success'){
    				$location.path("/");
    			} else {
    				alert('<?php echo $singularHumanName; ?> could not be updated.')
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
			.when('/edit/:id', {
				templateUrl : '/view/<?php echo $pluralVar ;?>/edit.html',
				controller  : '<?php echo $pluralHumanName; ?>EditController'
			})
			.when('/delete/:id', {
		        resolve: {
		            <?php echo $pluralVar ;?>Delete: function ($http, $route, $location) {
		               $http.delete('//<?php echo Configure::read('Cakeular.api_url') ?>/<?php echo $pluralVar ;?>/'+ $route.current.params.id)
						.success(function(data) {
							if(data.<?php echo $singularHumanName; ?>.type = 'success'){
								$location.path("/");
							} else {
								alert('<?php echo $singularHumanName; ?> could not be deleted.')
							}
						}).error(function (data, status, headers, config) {
							alert('<?php echo $singularHumanName; ?> could not be deleted.')
						});
		            }
		       }
			})
	});

})();