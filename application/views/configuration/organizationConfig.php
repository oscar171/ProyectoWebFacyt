<title>Configuración de Organización</title>
<div class="z-depth-1">
      <ul class="tabs" >
        <li class="tab"><a href="#departmentsContainer">Departamentos</a></li>
        <li class="tab tooltipped" ng-class="{disabled:(department.positions == null)}" data-position="bottom" data-delay="50" data-tooltip="Seleccione un departamento primero"><a href="#positionsContainer">Cargos</a></li>
      </ul>
</div>
<div id="departmentsContainer" class="container">
	<br>
        <h5 class="center-align" style="font-weight:300">Configuración de Departamentos de la Organización</h5>
    <br>
    <!-- Departments -->
	<div class="row">
	    <div class="col s12 m5 card-panel blue-grey darken-1">
	        <p class="white-text">
    	        En la Lista de departamentos se muestran todos los departamentos existentes.<br/>
    	        Para editar un departamento, haga click en <i class="material-icons">keyboard_arrow_down</i><br/>
    	        Al seleccionar un departamento, se habilitará la opción "Cargo" en la pestaña de arriba, en la cual podrá ver los cargos asociados a ese departamento.<br/>
    	        Para eliminar, click en <i class="material-icons">delete</i><br/>
    	        Para crear un nuevo departamento, haga click en "nuevo" al final de Detalles del departamento.
	        </p>
	    </div>
        <div class="col s12 m6 offset-m1 card-panel">
            <p class="center">Lista de departamentos</p>
            <table style="width:80%;margin:auto">
                <thead>
                    <th>#</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <tr ng-repeat="department in departments">
                        <td>{{$index+1}}</td>
                        <td>{{department.name}}</td>
                        <td><a class="btn-floating waves-effect waves-light" ng-click="loadDepartment($index)"><i class="material-icons">keyboard_arrow_down</i></a></td>
                        <td><a class="btn-floating waves-effect waves-light red" ng-click="deleteDepartment($index)"><i class="material-icons">delete</i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
	</div>
	<br/>
	<!-- Selected department's detail -->
    <div class="row" style="margin-left:20px; margin-right:20px">
        <h5 style="font-weight:300">Detalles del departamento {{department.name}}</h5>
        <form>
            <div id="department-details" class ="row card-panel">
                <div ng-show="editDepartment" class="input-field col s12">
                    <input id="name" ng-model="department.name" type="text">
                    <label for="name" ng-class="{active:isDepartmentLoaded()}">Nombre del departamento</label>
                </div>
                <div ng-show="!editDepartment" class="input-field col s12">
                    <input id="name" ng-model="department.name" readonly type="text">
                    <label for="name" ng-class="{active:isDepartmentLoaded()}">Nombre del departamento</label>
                </div>
                <div ng-show="editDepartment" class="input-field col s12">
                    <textarea id="description" ng-model="department.description" class="materialize-textarea"></textarea>
                    <label for="description" ng-class="{active:isDepartmentLoaded()}">Descripción del departamento</label>
                </div>
                <div ng-show="!editDepartment" class="input-field col s12">
                    <textarea id="description" ng-model="department.description" readonly class="materialize-textarea"></textarea>
                    <label for="description" ng-class="{active:isDepartmentLoaded()}">Descripción del departamento</label>
                </div>
                <div class="row right-align">
                    <md-button class="md-primary md-raised" ng-click="newDepartment()" ng-hide="editDepartment">Nuevo</md-button>
                    <md-button class="md-primary md-raised" ng-click="departmentEditMode()" ng-hide="editDepartment || noDepartmentUserInput()">Editar</md-button>
                    <md-button class="md-primary" ng-click="saveDepartment()" ng-show="editDepartment">Guardar</md-button>
                    <md-button class="md-primary md-raised" ng-click="departmentViewMode()" ng-show="editDepartment">Cancelar</md-button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="positionsContainer" class="container">
	<br>
        <h5 class="center-align" style="font-weight:300">Configuración de Cargos de {{department.name}}</h5>
    <br>
    <!-- Positions -->
    <div class="row">
        <div class="col s12 m6 card-panel">
            <p class="center">Lista de cargos dentro del departamento {{department.name}}</p>
            <table style="width:80%;margin:auto">
                <thead>
                    <th>#</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    
                    <tr ng-repeat="pos in department.positions">
                        <td>{{$index+1}}</td>
                        <td>{{pos.name}}</td>
                        <td><a class="btn-floating waves-effect waves-light" ng-click="loadPosition($index)"><i class="material-icons">keyboard_arrow_down</i></a></td>
                        <td><a class="btn-floating waves-effect waves-light red" ng-click="deletePosition($index)"><i class="material-icons">delete</i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
	    <div class="col s12 m5 offset-m1 card-panel blue-grey darken-1">
	        <p class="right-align white-text">
    	        En la Lista de cargos se muestran todos los cargos existentes dentro del departamento {{department.name}}.<br/>
    	        Para editar un cargo, haga click en <i class="material-icons">keyboard_arrow_down</i> del cargo de su elección.
    	        Para eliminarlo, haga click en <i class="material-icons">delete</i><br/>
    	        Para crear un cargo nuevo para el departamento de {{department.name}}, haga click en "nuevo" al final de Detalles del cargo.
	        </p>
	    </div>
	</div>
	<!-- Selected position's detail -->
    <div id="positions-table" class="row" style="margin-left:20px; margin-right:20px">
        <h5 style="font-weight:300">Detalles del cargo {{position.name}}</h5>
        <form>
            <div class ="row card-panel">
                <div ng-show="editPosition" class="input-field col s12">
                    <input id="name" ng-model="position.name" type="text">
                    <label for="name" ng-class="{active:isPositionLoaded()}">Nombre del cargo</label>
                </div>
                <div ng-show="!editPosition" class="input-field col s12">
                    <input id="name" ng-model="position.name" readonly type="text">
                    <label for="name" ng-class="{active:isPositionLoaded()}">Nombre del cargo</label>
                </div>
                <div ng-show="editPosition" class="input-field col s12">
                    <textarea id="description" ng-model="position.description" class="materialize-textarea"></textarea>
                    <label for="description" ng-class="{active:isPositionLoaded()}">Descripción del cargo</label>
                </div>
                <div ng-show="!editPosition" class="input-field col s12">
                    <textarea id="description" ng-model="position.description" readonly class="materialize-textarea"></textarea>
                    <label for="description" ng-class="{active:isPositionLoaded()}">Descripción del cargo</label>
                </div>
                <div class="row right-align">
                    <md-button ng-click="newPosition()" ng-hide="editPosition" class="md-primary md-raised">Nuevo</md-button>
                    <md-button ng-click="positionEditMode()" ng-hide="editPosition || noPositionUserInput()" class="md-primary md-raised">Editar</md-button>
                    <md-button ng-click="savePosition()" ng-show="editPosition" class="md-primary">Guardar</md-button>
                    <md-button ng-click="positionViewMode()" ng-show="editPosition" class="md-primary md-raised">Cancelar</md-button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('ul.tabs').tabs();
  });
</script>
