<title>Nuevo ticket</title>
<div class="container">
	<br>
	<div>
	    <h5 class="center-align" style="font-weight:300">Creación de un nuevo ticket</h5>
	    <h6 class="center-align">Por favor llene todos los datos necesarios, ¡y nuestros técnicos atenderán a su solicitud a la mayor brevedad posible!</h6>
	</div>
	<br>
    <div class ="row card-panel">
        <div class="input-field col s12">
            <i class="material-icons prefix">mode_edit</i>
            <input id="subject" type="text" ng-model="ticket.subject" length="55">
            <label for="subject">Asunto</label>
        </div>
    </div>
    <div class="row card-panel">
        <div class="input-field col s12">
                <i class="material-icons prefix">message</i>
                <textarea id="description" class="materialize-textarea" ng-model="ticket.description" length="500"></textarea>
                <label for="description">Descripción del incidente</label>
        </div>
    </div>
    
    <div class ="row">
        <div class="input-field col s12 m3">
            <select ng-model="ticket.type" material-select watch>
                <option ng-repeat="type in config.types">{{type}}</option>
            </select>
            <label>Tipo de incidente</label>
        </div>
        <div class="input-field col s12 m3">
            <select ng-model="ticket.level" material-select watch>
                <option ng-repeat="level in config.levels">{{level}}</option>
            </select>
            <label>Nivel</label>
        </div>
        <div class="input-field col s12 m3">
            <select ng-model="ticket.department" material-select watch>
                <option ng-repeat="department in departments">{{department.name}}</option>
            </select>
            <label>Departamento</label>
        </div>
        <div class="input-field col s12 m3">
            <select ng-model="ticket.priority" material-select watch>
                <option ng-repeat="priority in config.priorities">{{priority}}</option>
            </select>
            <label>Prioridad</label>
        </div>
    </div>
    <div class="row">
        <md-button class="col s4 offset-s4 m2 offset-m5 md-primary md-raised" ng-click="saveTicket()">Enviar</md-button>
   	</div>
</div>