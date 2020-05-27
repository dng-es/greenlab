<template>
    <form role="form" :action="url" :method="formmethod" class="form-media" :name="formid" :id="formid">
        <div class="input-group mb-3">
            <label class="sr-only" :for="inputid">{{ label }}</label>
            <input type="text" class="form-control" :id="inputid" :name="inputid" :placeholder="label" :value="inputvalue">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary" v-bind:class="btnstyle" :title="label"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
</template>

<script>
    module.exports = {
        
        props: {
            url:{
                type: String,
                default : ''
            }, 
            label:{
                type: String
            }, 
            btnstyle: {
                default : 'btn-primary'
            },
            inputvalue: {
                default : 'btn-primary'
            },
            formid: {
                default : 'searchForm'
            },
            formmethod: {
                default : 'get'
            },
            inputid: {
                default : 'search'
            },
        },
        data: function () {
            return {
            };
        }
        
    }
</script>
