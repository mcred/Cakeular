(function(){	
	var app = angular.module('app', ['ngRoute']);

	app.service('components', function() {
	    return {
	        paginate: function($scope,set){
				$scope.itemsPerPage = 20;
				$scope.currentPage = 0;
				$scope.prevPage = function() { 
					if ($scope.currentPage > 0) { $scope.currentPage--; } 
				};
				$scope.prevPageDisabled = function() { 
					return $scope.currentPage === 0 ? "disabled" : ""; 
				};
				$scope.pageCount = function() { 
					return Math.ceil(set.length/$scope.itemsPerPage); 
				};
				$scope.nextPage = function() { 
					if ($scope.currentPage < $scope.pageCount() -1 ) { $scope.currentPage++; } 
				};
				$scope.nextPageDisabled = function() { 
					return $scope.currentPage === $scope.pageCount() - 1 ? "disabled" : ""; 
				};
				$scope.range = function() {
					var rangeSize = 5;
					var ret = [];
					var start;
					start = $scope.currentPage;
					if ( start > $scope.pageCount()-rangeSize ) { start = $scope.pageCount()-rangeSize + 1; }
					if ( start <= 0 ) { start = 0; }
					var end = start + rangeSize;
					if ( end > $scope.pageCount() ) { end = $scope.pageCount();	}
					for (var i=start; i < end; i++) { 
						ret.push(i);
					}
					return ret;
				};
				$scope.setPage = function(n) { 
					$scope.currentPage = n; 
				};
				return $scope;
			},

	    }
	});

	app.filter('offset', function() {
		return function(input, start) {
			start = parseInt(start, 10);
			return input.slice(start);
		};
	});

})();