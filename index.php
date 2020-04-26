<!DOCTYPE html>
<html lang="en">
<head>
    <!-- AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body ng-app='myapp'>

<table ng-controller="marksCtrl" border="1" cellpadding="3" cellspacing="0">
    <tr>
        <th ng-repeat="row in Marks['headers']">{{ row }}</th>
    </tr>
    <tr ng-repeat="row in Marks['data']">
        <td ng-repeat="column in row">
            {{ column }}
        </td>
    </tr>
</table>

<script>
    $(window).on('load', ajaxLoadMarksTable());

    function ajaxLoadMarksTable() {
        //AngularJS modelis
        var fetch = angular.module('myapp', []);
        //AngularJS controlleris
        fetch.controller('marksCtrl', ['$scope', '$http', function ($scope, $http) {
            $scope.getMarks = function () {
                $http({
                    method: 'POST',
                    data: {action: 'getAvgMarksTable'},
                    url: 'fetch.php',
                    dataType: "json"
                }).then(function (response) {
                    $scope.Marks = response.data;
                });
            }
            //controlleris sukuria atributa `Marks` nurodytame $scope su json informacija is url
            $scope.getMarks();
        }]);
    }
</script>

</body>
</html>