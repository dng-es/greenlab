<template>
    <div class="row">
        <div  v-bind:class="[dates == 'true' ? 'col-md-4' : 'col-md-12']">   
            <div class="input-group mb-3 my-group">   
                <label class="sr-only" for="exportOption">{{ label }}</label>   
                <select id="exportOption" class="selectpicker form-control" data-live-search="true">
                    <option value="xlsx">xlsx</option>
                    <option value="csv">csv</option>
                    <option value="xls">xls</option>
                </select> 
                <span class="input-group-append">
                    <button class="btn" v-bind:class="btnstyle" type="button" v-on:click="exportData"><i class="fa fa-download"></i></button>
                </span>
            </div>
        </div>

        <div v-if="dates == 'true'" class="col-md-4">
            <input id="export_ini" type="text" class="form-control" name="export_ini" placeholder="Fecha inicio" value="" />
        </div>

        
        <div v-if="dates == 'true'" class="col-md-4">   
            <input id="export_end" type="text" class="form-control" name="export_end" placeholder="Fecha fin" value="" />
        </div>
    </div>
</template>

<script>
    module.exports = {
        
        props: {
            dates:{
                default : false
            }, 
            url:{
                type: String
            }, 
            label:{
                type: String
            }, 
            btnstyle: {
                default : 'btn-primary'
            }
        },
        data: function () {
            return {
            };
        },
        methods: {
            exportData: function (event) {
                var export_ini = ($('#export_ini').length > 0 ? $('#export_ini').val() : ''),
                    export_end = $('#export_end').length > 0 ? $('#export_end').val() : '';
                document.location.href = this.url + "/" + $("#exportOption").val() + '?export_ini=' + export_ini + '&export_end=' + export_end;
            }
        }

        
    }
    jQuery(document).ready(function(){
      if ($('#export_ini').length > 0){
          $('#export_ini, #export_end').bootstrapMaterialDatePicker({ 
            format : 'YYYY-MM-DD', 
            time : false,
            lang : 'es', 
            weekStart : 1, 
            cancelText : 'Cancelar' 
          });
      }
    });
</script>