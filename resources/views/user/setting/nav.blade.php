<div class="col-md-3">
    <div class="panel panel-info panel-flush">
        <div class="panel-heading">Настройки</div>
        <div class="panel-body">
        	<div class="spark-settings-tabs">
        		<ul class="nav spark-settings-stacked-tabs">
        			<li class="
                    {{
                        Request::is('setting')? 'active': ''
                    }}
                    ">
        				<a href="{{ url('/setting') }}">Главные</a>
        			</li>
	            </ul>
        	</div>
        </div>
    </div>
</div>